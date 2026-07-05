FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

EXPOSE 8000

CMD touch .env && \
    echo "APP_KEY=${APP_KEY}" >> .env && \
    echo "APP_ENV=${APP_ENV}" >> .env && \
    echo "APP_DEBUG=${APP_DEBUG}" >> .env && \
    echo "APP_URL=${APP_URL}" >> .env && \
    echo "DB_CONNECTION=${DB_CONNECTION}" >> .env && \
    echo "DB_HOST=${DB_HOST}" >> .env && \
    echo "DB_PORT=${DB_PORT}" >> .env && \
    echo "DB_DATABASE=${DB_DATABASE}" >> .env && \
    echo "DB_USERNAME=${DB_USERNAME}" >> .env && \
    echo "DB_PASSWORD=${DB_PASSWORD}" >> .env && \
    echo "SESSION_DRIVER=${SESSION_DRIVER}" >> .env && \
    echo "CACHE_STORE=${CACHE_STORE}" >> .env && \
    echo "QUEUE_CONNECTION=${QUEUE_CONNECTION}" >> .env && \
    echo "FILESYSTEM_DISK=${FILESYSTEM_DISK}" >> .env && \
    php artisan config:clear && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}