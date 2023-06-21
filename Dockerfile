FROM php:8.1.1-apache

RUN a2enmod headers rewrite

RUN apt-get update && apt-get install -y \ 
    vim \ 
    wget \ 
    unzip \
    libzip-dev \
    zip

RUN docker-php-ext-install pdo pdo_mysql mysqli zip

RUN docker-php-ext-enable pdo pdo_mysql mysqli zip

WORKDIR /var/www/html

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

CMD ["apache2-foreground"]

