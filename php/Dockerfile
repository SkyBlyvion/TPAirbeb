FROM php:8.2-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# Install composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfo
# ENV PHP_OPEN_BASEDIR=/var/www/symfo

# The maximum size of an uploaded file
# ENV PHP_UPLOAD_MAX_FILE_SIZE="100M"