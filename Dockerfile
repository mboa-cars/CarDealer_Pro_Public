# Utilise une image PHP avec FPM
FROM php:8.2-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    npm \
    nodejs

# Installe les extensions PHP nécessaires à Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le répertoire de travail
WORKDIR /var/www

# Copie les fichiers Laravel dans le conteneur
COPY . /var/www

# Donne les bons droits (facultatif mais recommandé)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Configuration PHP-FPM pour éviter les timeouts
RUN echo "request_terminate_timeout = 300s" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "max_input_time = 300" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Expose le port FPM
EXPOSE 9000

CMD ["php-fpm"] 