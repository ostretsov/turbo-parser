FROM php:7.2.2-cli-stretch

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/bin

EXPOSE 80

# CMD & other stuff