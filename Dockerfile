FROM php:8.2-apache

# Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Deshabilitar MPMs conflictivos y asegurar solo el prefork
RUN a2dismod mpm_event mpm_worker || true && \
    a2enmod mpm_prefork

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Configurar Apache para usar el MPM correcto
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copiar archivos del proyecto
COPY . /var/www/html/

# Exponer puerto 80
EXPOSE 80
