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

# Install a dedicated, cache-busted stylesheet in both supported themes.
# Loading it at the end of <head> ensures it wins over theme and Bootstrap rules.
RUN for theme in default bootstrap; do \
      if [ -f "/var/www/html/themes/$theme/header.php" ] && [ -f "/var/www/html/themes/$theme/css/flux.css" ]; then \
        cp /tmp/fluxcp-website/fluxcp-overrides.css "/var/www/html/themes/$theme/css/ro-custom.css"; \
        php -r '$p=$argv[1]; $s=file_get_contents($p); $q=chr(34); $link = "        <link rel=".$q."stylesheet".$q." href=".$q."<?php echo \$this->themePath(".chr(39)."css/ro-custom.css".chr(39).") ?>?v=20261108-floating-menu-1".$q." type=".$q."text/css".$q." media=".$q."screen".$q." />\n"; if (strpos($s, "ro-custom.css") === false) { $s=str_replace("</head>", $link."</head>", $s); file_put_contents($p, $s); }' "/var/www/html/themes/$theme/header.php"; \
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
