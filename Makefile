all: install

install:
	cp -n docker.env .env

	docker-compose up --no-deps -d php-fpm

	docker exec -ti fleet-control-master-php sh -c "composer install"

	docker-compose up -d

update:
	docker-compose up --build --force-recreate --no-deps -d php-fpm

	docker exec -ti fleet-control-master-php sh -c "composer update"

	docker-compose up --build --force-recreate -d

optimize_autoloader:
	docker exec -ti fleet-control-master-php sh -c "composer install --optimize-autoloader"

bash:
	docker-compose up --no-deps -d php-fpm

	docker exec -ti fleet-control-master-php sh
