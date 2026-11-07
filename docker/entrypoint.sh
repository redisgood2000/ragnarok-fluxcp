#!/bin/sh
set -eu

: "${PORT:=80}"
case "$PORT" in
  ''|*[!0-9]*) echo "PORT must be a numeric TCP port" >&2; exit 1 ;;
esac

# Enforce exactly one Apache MPM at runtime.
a2dismod mpm_event >/dev/null 2>&1 || true
a2dismod mpm_worker >/dev/null 2>&1 || true
a2dismod mpm_prefork >/dev/null 2>&1 || true
rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf
rm -f /etc/apache2/mods-enabled/mpm_worker.load /etc/apache2/mods-enabled/mpm_worker.conf
rm -f /etc/apache2/mods-enabled/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.conf
a2enmod mpm_prefork rewrite headers >/dev/null

MPM_COUNT="$(grep -RhsE '^[[:space:]]*LoadModule[[:space:]]+mpm_(event|worker|prefork)_module' /etc/apache2/mods-enabled /etc/apache2/conf-enabled 2>/dev/null | wc -l)"
if [ "$MPM_COUNT" -ne 1 ]; then
  echo "FATAL: expected exactly one enabled Apache MPM, found $MPM_COUNT" >&2
  find /etc/apache2/mods-enabled -maxdepth 1 -type l -name 'mpm_*' -ls >&2 || true
  grep -RnsE '^[[:space:]]*LoadModule[[:space:]]+mpm_(event|worker|prefork)_module' /etc/apache2 2>/dev/null >&2 || true
  exit 1
fi

# Verify the app's private-network database credentials before serving traffic.
# Never print credential values to Railway logs.
cat > /tmp/fluxcp-db-check.php <<'PHP'
<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: '3306';
$name = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

if (!$host || !$name || !$user || $pass === false || $pass === '') {
    fwrite(STDERR, "FluxCP DB connectivity check: required DB environment variable is missing.\n");
    exit(1);
}

$dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
$lastError = null;
for ($attempt = 1; $attempt <= 15; $attempt++) {
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5,
        ]);
        $result = $pdo->query('SELECT 1')->fetchColumn();
        if ((int)$result !== 1) {
            throw new RuntimeException('Unexpected SELECT 1 result');
        }
        fwrite(STDOUT, "FluxCP DB connectivity check: PASS (MariaDB connection and SELECT 1 succeeded).\n");
        exit(0);
    } catch (Throwable $error) {
        $lastError = $error;
        sleep(2);
    }
}
fwrite(STDERR, "FluxCP DB connectivity check: FAIL after 15 attempts; check Railway private host, port, database name, username, password, and MariaDB readiness.\n");
exit(1);
PHP

if ! php /tmp/fluxcp-db-check.php; then
  echo "WARNING: FluxCP will start, but database connectivity is not verified." >&2
fi
rm -f /tmp/fluxcp-db-check.php

# Railway assigns the listening port dynamically.
sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

mkdir -p /var/www/html/data/logs /var/www/html/data/tmp /var/www/html/data/itemshop
chown -R www-data:www-data /var/www/html/data

exec docker-php-entrypoint "$@"
