FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    docker-php-ext-install pdo pdo_mysql
    
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www