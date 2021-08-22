FROM php:8-apache
COPY . /var/www/html
WORKDIR /var/www/html
EXPOSE 80
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
CMD ["apache2-foreground"]