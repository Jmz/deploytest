FROM php:7.0.4-fpm-alpine

RUN apk add --update git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN git clone -b master --depth=1 https://github.com/Jmz/deploytest.git /var/www/html/application

RUN cd /var/www/html/application && composer install

CMD ["php-fpm"]
