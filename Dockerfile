# Використовуємо офіційний образ PHP
FROM php:7.4-fpm

# Встановлюємо необхідні розширення PHP
RUN docker-php-ext-install pdo pdo_mysql

# Встановлюємо Composer
RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Встановлюємо Node.js та npm
RUN apt-get update && apt-get install -y \
    nodejs \
    npm \
    zip \
    unzip