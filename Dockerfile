FROM php:7.4-apache

# Install the MySQLi extension
RUN docker-php-ext-install mysqli
