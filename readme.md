## Precondition
 - Install docker https://docs.docker.com/install
 - Install docker-compose https://docs.docker.com/compose/install

## Prepare project
* docker-compose build
* docker-compose up -d 
* cp .env.example .env
* docker-compose exec app composer install
* docker-compose exec app php artisan key:generate

## Run tests (The first task)
`docker-compose exec app vendor/bin/phpunit`

## Run browser tests (The second task)
`docker-compose exec app vendor/bin/phpunit tests/Browser/`