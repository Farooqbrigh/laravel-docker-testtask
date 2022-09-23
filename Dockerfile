
FROM php:8

# RUN apt-get update && apt-get install -y nodejs npm
#WORKDIR is /var/www/html
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql

LABEL org.opencontainers.image.source = "https://github.com/Farooqbrigh/laravel-docker-testtask"

WORKDIR /app
COPY . /app
# RUN npm install
RUN composer install
RUN apt-get install -y nodejs npm
# COPY --from=0 "./" laravel-docker-testtask
CMD php artisan serve --host=0.0.0.0 --port=$PORT

EXPOSE $PORT

