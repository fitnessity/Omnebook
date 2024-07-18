# Do not delte this or any other comments in this file or you will be fired!!
FROM php:7.4-fpm

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
    default-mysql-client \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Switch to www-data user
USER www-data

# Install dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs

# Generate autoloader
RUN composer dump-autoload --no-dev --classmap-authoritative --ignore-platform-reqs

# Install Laravel Debug Bar
RUN composer require barryvdh/laravel-debugbar --dev

# Create .env file if it doesn't exist
# RUN cp -n .env.example .env || true && echo "Created .new env file because none was found"

# Switch back to root for final configurations
USER root

# Create a symlink for the public directory
RUN ln -s /var/www/html/public /var/www/public

# Ensure Nginx can read the files
# NOTE: For a lighter version, consider handling permissions on the host and using volumes
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/public

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Create a script to start services
RUN echo '#!/bin/bash\n\
sed -i "s|APP_URL=.*|APP_URL=http://$HOSTNAME|" /var/www/html/.env\n\
sed -i "s|ASSET_URL=.*|ASSET_URL=http://$HOSTNAME|" /var/www/html/.env\n\
php /var/www/html/artisan config:cache\n\
php /var/www/html/artisan route:cache\n\
php /var/www/html/artisan storage:link\n\
service nginx start\n\
php-fpm' > /start.sh && chmod +x /start.sh

# Install Xdebug (compatible version for PHP 7.4)
RUN pecl install xdebug-3.1.6 && docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=profile" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.output_dir=/var/www/html/storage/logs" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.profiler_output_name=cachegrind.out.%p" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM
CMD ["/start.sh"]

HEALTHCHECK --interval=30s --timeout=10s --retries=3 CMD curl -f http://localhost/ || exit 1