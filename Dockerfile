FROM composer AS build-stage

COPY ./src /code
RUN cd /code && \
    composer install \
    --no-interaction \
    --no-dev \
    --no-progress \
    --no-suggest \
    --no-ansi \
    --prefer-dist \
    --no-scripts \
    --optimize-autoloader \
    --ignore-platform-reqs

#### final stages ####

FROM php:7.0-cli-jessie

RUN docker-php-ext-install -j$(nproc) pcntl && \
    mkdir -p /code

COPY config/php.ini /usr/local/etc/php/
COPY --from=build-stage /code/ /code

WORKDIR /code

ENTRYPOINT []
CMD ["php", "/code/artisan", "queue:work", "--daemon", "--queue=redis", "redis"]

RUN ln -s /proc/self/fd/1 /code/storage/logs/laravel.log
