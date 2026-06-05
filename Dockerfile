FROM php:8.2-apache

# Desactivar todos los MPM primero y activar solo prefork
RUN apt-get update && apt-get install -y libapache2-mod-php8.2 2>/dev/null; \
    a2dismod mpm_event mpm_worker 2>/dev/null; \
    a2enmod mpm_prefork rewrite

# Copiar todo el proyecto
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# Configurar Apache para permitir .htaccess
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

EXPOSE 80