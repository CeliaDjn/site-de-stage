# Dockerfile
FROM php:8.2-apache

# Installe PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

