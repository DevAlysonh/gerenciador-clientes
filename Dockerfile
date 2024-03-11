FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
	git \
	curl \
	libpng-dev \
	libonig-dev \
	libxml2-dev \
	zip \
	unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# install php extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# install composer to create laravel a project
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www