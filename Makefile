init:
	docker-compose up -d
	docker-compose exec php-cli composer install
	docker-compose exec node npm install
    docker-compose exec node npm run prod
    cp .env.example .env
    chmod -R 777 storage
    docker-compose exec php-cli php artisan migrate
