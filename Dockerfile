FROM php:8.2-apache

ARG CACHEBUST=1

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN rm -f /etc/apache2/mods-enabled/mpm_event.conf \
          /etc/apache2/mods-enabled/mpm_event.load \
          /etc/apache2/mods-enabled/mpm_worker.conf \
          /etc/apache2/mods-enabled/mpm_worker.load \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/ \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/ \
    && a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]