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

# Expose le port FPM
EXPOSE 9000

CMD ["php-fpm"] 