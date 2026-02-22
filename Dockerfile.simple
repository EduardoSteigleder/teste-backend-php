FROM php:8.2-cli

RUN apt-get update && apt-get install -y git curl libpq-dev libsqlite3-dev sqlite3 unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_sqlite pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction 2>&1 | grep -i error || true

RUN mkdir -p database storage bootstrap/cache && \
    touch database/database.sqlite && \
    chmod 777 database/database.sqlite

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
