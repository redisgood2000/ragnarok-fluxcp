FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli gd \
    && rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf \
    && a2enmod mpm_prefork rewrite headers \
    && test "$(apache2ctl -M 2>/dev/null | grep -Ec 'mpm_(event|worker|prefork)_module')" -eq 1 \
    && rm -rf /var/lib/apt/lists/*

# Pull the maintained upstream control panel; custom files below are a small,
# version-independent presentation overlay and do not replace FluxCP modules.
RUN git clone --depth 1 --branch master https://github.com/rathena/FluxCP.git /var/www/html

COPY config/import/ /var/www/html/config/import/
COPY website/ /tmp/fluxcp-website/
# Bootstrap inherits page templates from Default, but has its own stylesheet.
# Patch every theme stylesheet independently, and replace the inherited Default
# homepage once so both themes render the same custom landing page.
RUN for theme in default bootstrap; do \
      if [ -f "/var/www/html/themes/$theme/css/flux.css" ]; then \
        cat /tmp/fluxcp-website/fluxcp-overrides.css >> "/var/www/html/themes/$theme/css/flux.css"; \
      fi; \
    done \
    && cp /tmp/fluxcp-website/main-index.php /var/www/html/themes/default/main/index.php \
    && rm -rf /tmp/fluxcp-website

COPY docker/entrypoint.sh /usr/local/bin/fluxcp-entrypoint

RUN chmod +x /usr/local/bin/fluxcp-entrypoint \
    && mkdir -p /var/www/html/data/logs /var/www/html/data/tmp /var/www/html/data/itemshop \
    && chown -R www-data:www-data /var/www/html/data

ENV APACHE_DOCUMENT_ROOT=/var/www/html
EXPOSE 80

ENTRYPOINT ["fluxcp-entrypoint"]
CMD ["apache2-foreground"]
