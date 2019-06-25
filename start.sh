#!/bin/bash

composer install

touch database/database.sqlite

php artisan migrate --seed

php artisan serve