FROM php:7.4-fpm

RUN apt-get update -y && \
    apt-get install -y --no-install-recommends git zip unzip libpq-dev zlib1g-dev libpng-dev libzip-dev mariadb-client

RUN docker-php-ext-install pdo_mysql pcntl gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install xdebug-3.1.5 && docker-php-ext-enable xdebug;

WORKDIR /var/www

EXPOSE 9000
