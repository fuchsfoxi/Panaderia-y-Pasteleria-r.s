FROM php:8.2-apache

# Copiar todo el proyecto
COPY . /var/www/html/

# Dar permisos y configurar Apache en un solo paso
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite \
    && echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

EXPOSE 80