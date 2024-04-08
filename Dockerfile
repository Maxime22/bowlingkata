FROM php:8.3-alpine

WORKDIR /app

# Installer les dépendances pour PHPUnit
RUN apk add --no-cache git

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY .. /app