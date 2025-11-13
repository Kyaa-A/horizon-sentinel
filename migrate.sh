#!/bin/bash

# Clear old database environment variables
unset DB_CONNECTION DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD

# Run migrations using direct connection (better for migrations)
php artisan migrate --database=pgsql_direct "$@"
