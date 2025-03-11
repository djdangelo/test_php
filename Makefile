start:
	docker-compose up -d

stop:
	docker-compose down

test:
	docker-compose exec php ./vendor/bin/phpunit