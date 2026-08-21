FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts

FROM php:8.3-cli-bookworm
RUN apt-get update \
    && apt-get install -y --no-install-recommends libsqlite3-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_sqlite mbstring dom xml \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY --from=vendor /app/vendor ./vendor
COPY . .
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache public/uploads database \
    && touch database/database.sqlite \
    && chmod -R 777 storage bootstrap/cache public/uploads database
EXPOSE 8000
CMD ["sh","-c","php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=8000"]
