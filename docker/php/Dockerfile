FROM php:8.1-apache
EXPOSE 80

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
RUN composer require doctrine/orm symfony/event-dispatcher symfony/http-foundation
CMD ['apache-foreground']