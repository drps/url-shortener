Развернуть проект можно так

* `make init`

Либо если не установлен make 

* `docker-compose up -d`
* `docker-compose exec php-cli composer install`
* `docker-compose exec node npm install`
* `docker-compose exec node npm run prod`
* `docker-compose exec php-cli cp .env.example .env`
* `docker-compose exec php-cli chmod -R 777 storage`
* `docker-compose exec php-cli php artisan migrate`
