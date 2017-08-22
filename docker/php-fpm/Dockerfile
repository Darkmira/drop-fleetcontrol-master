FROM php:7-fpm-alpine

RUN cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install bcmath
