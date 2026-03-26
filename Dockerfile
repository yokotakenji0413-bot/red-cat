FROM php:8.4-cli

WORKDIR /var/www

COPY . .

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000