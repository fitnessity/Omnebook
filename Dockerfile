FROM php:7.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache modules
RUN a2enmod rewrite

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# Change permission of storage directory
RUN chmod -R 775 storage bootstrap/cache

# Switch to www-data user
USER www-data

# Debug: Print content of helpers.php before modification
# RUN echo "Content of helpers.php before modification:" && cat /var/www/html/app/helpers/helpers.php

# # Temporarily modify helpers.php
# RUN sed -i 's/use View;/\/\/ use View;/' /var/www/html/app/helpers/helpers.php
# RUN sed -i 's/use DateTime;/\/\/ use DateTime;/' /var/www/html/app/helpers/helpers.php

# # Debug: Print content of helpers.php after modification
# RUN echo "Content of helpers.php after modification:" && cat /var/www/html/app/helpers/helpers.php

# Install dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs

# Generate autoloader with verbose output
RUN composer dump-autoload --no-dev --classmap-authoritative --ignore-platform-reqs -vvv

# Create .env file if it doesn't exist
RUN cp -n .env.example .env || true

# Switch back to root for Apache configuration
USER root

# Set up Apache DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]
