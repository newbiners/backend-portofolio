# FROM php:8.2-apache

# # Instal ekstensi PDO MySQL
# RUN docker-php-ext-install pdo pdo_mysql

# # Copy aplikasi web
# COPY ./www /var/www/html

# # Aktifkan mod_rewrite untuk Apache
# RUN a2enmod rewrite

# # Set proper permissions
# RUN chown -R www-data:www-data /var/www/html

# Menggunakan image php:8.2-apache sebagai basis


# Menggunakan image php:8.2-apache sebagai basis
FROM php:8.2-apache

# Install dependencies yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY www/composer.json www/composer.lock ./

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction

# Copy application files
COPY www /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html
