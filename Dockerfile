FROM php:8.2-apache

RUN docker-php-ext-install mysqli

# Limpiar TODOS los MPM (load y conf)
RUN rm -f /etc/apache2/mods-enabled/mpm_*

# Forzar SOLO prefork manualmente
RUN echo "LoadModule mpm_prefork_module /usr/lib/apache2/modules/mod_mpm_prefork.so" > /etc/apache2/mods-enabled/mpm_prefork.load

# Activar rewrite (este sí normal)
RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
