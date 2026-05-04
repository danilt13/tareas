FROM php:8.2-apache

RUN docker-php-ext-install mysqli

# Limpiar configuración de MPMs
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load

# Habilitar solo prefork
RUN a2enmod mpm_prefork rewrite

COPY . /var/www/html/

EXPOSE 80
