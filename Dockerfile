# Using the official PHP image
FROM php:7.4-fpm

# Set the working directory
WORKDIR /var/www/html

# Update the package manager and install necessary packages
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    curl \
    git \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install xml zip mbstring bcmath pdo_mysql


# Copy project files into the container
COPY . /var/www/html

# Copy composer files
COPY composer.json composer.lock /var/www/html/

# Install Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Install Composer dependencies
RUN composer install

# Update Composer
RUN composer update

# Expose port 9000 
EXPOSE 9000