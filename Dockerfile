# Use the official PHP image as the base image
FROM php:8.1-fpm

# Set the working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files to the container
COPY . .

# Install application dependencies
RUN composer install --no-interaction --no-scripts --no-suggest

# Generate application key
RUN php artisan key:generate

# Set the permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]