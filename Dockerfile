# Using the official PHP image
FROM php:7.4-fpm

# Set the working directory
WORKDIR /var/www/html

# Update the package manager and install necessary packages
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    curl \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install xml zip mbstring bcmath pdo_mysql

# Install Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Copy project files into the container
COPY . /var/www/html

# Install Composer dependencies
RUN composer install

# Update Composer
RUN composer update

# Change ownership and permissions for logs directory and files
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

# Expose port 9000 
EXPOSE 9000