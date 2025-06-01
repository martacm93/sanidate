# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev curl nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilita mod_rewrite en Apache
RUN a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el código del proyecto
COPY . /var/www

# Apunta Apache al directorio `public`
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Ajusta configuración de Apache para que use ese docroot
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/apache2.conf


# Establece el directorio de trabajo
WORKDIR /var/www/html

# Cambia permisos de los directorios necesarios para Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Instala dependencias PHP y JS + compila assets + setup
RUN composer install --no-dev --optimize-autoloader && \
    npm install && \
    npm run build && \
    php artisan optimize && \
    chmod -R 777 storage && \
    chmod -R 777 bootstrap/cache && \
    php artisan storage:link || true

# Establece permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto de Apache
EXPOSE 80

# Comando de arranque
CMD ["apache2-foreground"]

