FROM bushelpowered/alpine-laravel:5.x-php7.3
MAINTAINER David Kanenwisher <d.kanen@gmail.com>

# Add the the Laravel project
COPY . /var/www/
RUN composer install --ansi --no-interaction --no-progress --no-suggest

