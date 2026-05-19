FROM php:8.2-apache

# Instalar drivers necesarios
RUN apt-get update && apt-get install -y libpq-dev

# Instalar extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mysqli

# Activar rewrite
RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
