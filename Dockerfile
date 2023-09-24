FROM php:7.4-apache
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN cd /var/www/html && composer install
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap
CMD ["apache2-foreground"]
