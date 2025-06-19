#!/bin/bash

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Serve Laravel app
php artisan serve --host=0.0.0.0 --port=10000
