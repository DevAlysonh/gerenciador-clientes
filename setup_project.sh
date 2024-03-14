#!/bin/bash

if ! command -v docker &> /dev/null; then
    echo "Docker não encontrado. Por favor, instale o Docker para continuar."
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "Docker Compose não encontrado. Por favor, instale o Docker Compose para continuar."
    exit 1
fi

touch ./database/database.sqlite

absolut_path=$(readlink -f ./database/database.sqlite)

cp .env.example .env

echo "DB_CONNECTION=sqlite" >> .env
echo "DB_HOST=$absolut_path" >> .env

docker-compose up -d

docker-compose exec -it app composer install

docker-compose exec -it app php artisan migrate

npm install && npm run dev
