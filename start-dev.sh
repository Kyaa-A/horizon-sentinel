#!/bin/bash

# Clear old database environment variables
unset DB_CONNECTION DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD

# Start Laravel development environment
composer dev
