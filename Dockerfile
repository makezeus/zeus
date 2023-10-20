FROM php:7.4

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y git unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80"]
