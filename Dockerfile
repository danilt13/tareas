FROM php:8.2-apache

# Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite de Apache (opcional, para URLs amigables)
RUN a2enmod rewrite

# Copiar todos los archivos del proyecto al servidor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80