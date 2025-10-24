FROM php:8.3-apache

# Instala dependências
RUN apt update && apt install -y libffi-dev libz-dev libpng-dev git libzip-dev unzip curl \
    && docker-php-ext-install ffi sockets gd pcntl zip \
    && a2enmod rewrite

# Habilita FFI
RUN echo "ffi.enable=1" > /usr/local/etc/php/conf.d/ffi.ini

# Aumenta limite de memória e tempo máximo de execução
RUN echo "memory_limit=1024M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "max_execution_time=120" > /usr/local/etc/php/conf.d/max-exec.ini

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Copia código
COPY . /var/www/html
WORKDIR /var/www/html

# Instala TransformersPHP
RUN composer require codewithkyrian/transformers

EXPOSE 80