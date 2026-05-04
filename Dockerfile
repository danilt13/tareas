FROM php:8.2-apache

# Instalar extensión MySQL
RUN docker-php-ext-install mysqli

# Desactivar TODOS los MPM primero (bien hecho)
RUN a2dismod mpm_event mpm_worker mpm_prefork || true

# Activar solo prefork
RUN a2enmod mpm_prefork rewrite

# Copiar archivos
COPY . /var/www/html/

# Permisos (recomendado)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
