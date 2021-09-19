# FROM php:8.0.9
FROM php:7.4-fpm

RUN groupadd -g 1000 user
RUN useradd -d /var/www/laravel -s /bin/bash -u 1000 -g 1000 user
RUN mkdir -p /var/www/laravel
RUN chown -R user:user /var/www/laravel

WORKDIR /var/www/laravel

RUN apt update \
    && apt install -y \
    g++ \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    zlib1g-dev \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_pgsql \
    pgsql \
    sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer