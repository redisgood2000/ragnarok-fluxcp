FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli gd \
    # Ensure Apache loads exactly one MPM; the PHP Apache image uses prefork. \
    && (a2dismod mpm_event mpm_worker mpm_prefork >/dev/null 2>&1 || true) \
    && a2enmod mpm_prefork rewrite headers \
    && apache2ctl -M | grep -q 'mpm_prefork_module' \
    && rm -rf /var/lib/apt/lists/*

# Pull the maintained upstream control panel; this repository contains only
# the Railway deployment layer and environment-specific configuration.
RUN git clone --depth 1 --branch master https://github.com/rathena/FluxCP.git /var/www/html

COPY config/import/ /var/www/html/config/import/
COPY docker/entrypoint.sh /usr/local/bin/fluxcp-entrypoint

RUN chmod +x /usr/local/bin/fluxcp-entrypoint \
    && mkdir -p /var/www/html/data/logs /var/www/html/data/tmp /var/www/html/data/itemshop \
    && chown -R www-data:www-data /var/www/html/data

ENV APACHE_DOCUMENT_ROOT=/var/www/html
EXPOSE 80

ENTRYPOINT ["fluxcp-entrypoint"]
CMD ["apache2-foreground"]
