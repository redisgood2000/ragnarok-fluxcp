#!/bin/sh
set -eu

: "${PORT:=80}"
case "$PORT" in
  ''|*[!0-9]*) echo "PORT must be a numeric TCP port" >&2; exit 1 ;;
esac

# Enforce exactly one Apache MPM at runtime, after the image entrypoint setup.
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

# Railway assigns the listening port dynamically.
sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

mkdir -p /var/www/html/data/logs /var/www/html/data/tmp /var/www/html/data/itemshop
chown -R www-data:www-data /var/www/html/data

exec docker-php-entrypoint "$@"
