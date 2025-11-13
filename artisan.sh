#!/bin/bash

# Clear old database environment variables to use .env values
unset DB_CONNECTION DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD

# Run any artisan command with clean environment
php artisan "$@"
