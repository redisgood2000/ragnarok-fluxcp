#!/bin/sh
set -eu

: "${PORT:=80}"
case "$PORT" in
  ''|*[!0-9]*) echo "PORT must be a numeric TCP port" >&2; exit 1 ;;
esac

# Railway assigns the listening port dynamically.
sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

mkdir -p /var/www/html/data/logs /var/www/html/data/tmp /var/www/html/data/itemshop
chown -R www-data:www-data /var/www/html/data

exec docker-php-entrypoint "$@"
