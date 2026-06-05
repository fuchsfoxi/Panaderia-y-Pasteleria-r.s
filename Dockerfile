FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Deshabilita MPMs en conflicto, deja solo prefork (necesario para mod_php)
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]