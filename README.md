### Развернуть проект можно так

* `docker-compose build`
* `docker-compose up -d`
* `docker-compose exec php-cli composer install`
* `docker-compose exec node npm install`
* `docker-compose exec node npm run prod`
* `docker-compose exec php-cli cp .env.example .env`
* `docker-compose exec php-cli chmod -R 777 storage`
* `docker-compose exec php-cli php artisan migrate`

### Запуск тестов

`docker-compose exec php-cli php artisan test`

### Ссылки приложения

* Главная https://localhost:8080
* Статистика общая https://localhost:8080/stat-all
* Ссылка на статистику отдельной ссылки появляется один раз при сохранении
