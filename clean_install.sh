#!/bin/bash

echo "Seeding database (with --fresh option)..."
php artisan migrate:fresh --seed

echo "Running Artisan commands with arguments..."
php artisan make:filament-user --name="Shopa Admin" --email="admin@shopa.com" --password="password"

echo "Configuring admin..."
php artisan app:configure-admin

echo "Clearing cache..."
php artisan optimize:clear

echo "Clearing filament assets..."
php artisan filament:clear-cached-components

echo "All Artisan commands executed with successfully"
