FROM php:8.2-apache

# Deshabilitar MPM event y activar solo prefork (evita el conflicto)
RUN a2dismod mpm_event && a2enmod mpm_prefork

# Habilitar mod_rewrite para MVC
RUN a2enmod rewrite

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