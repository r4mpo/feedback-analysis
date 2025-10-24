FROM php:8.3-apache

RUN apt update && apt install -y libffi-dev libz-dev libpng-dev git libzip-dev unzip curl \
    && docker-php-ext-install ffi sockets gd pcntl zip \
    && a2enmod rewrite

# Habilita FFI e aumenta memória
RUN echo "ffi.enable=1" > /usr/local/etc/php/conf.d/ffi.ini \
    && echo "memory_limit=1024M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Instala composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

COPY . /var/www/html
WORKDIR /var/www/html

RUN composer require codewithkyrian/transformers

EXPOSE 80