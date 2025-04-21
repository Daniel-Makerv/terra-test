FROM php:8.2-fpm

RUN apt-get update && apt-get install -y zip unzip && docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-interaction && composer dump-autoload

RUN mkdir -p logs && touch logs/app.log && chmod -R 777 logs
