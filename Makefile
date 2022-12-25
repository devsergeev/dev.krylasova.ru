docker-compose = docker-compose -f ./docker/docker-compose.yml --env-file ./docker/.env
docker-exec = $(docker-compose) exec
docker-run = $(docker-compose) run --rm
php-apache = $(docker-exec) php-apache
node = $(docker-exec) node
php-cli = $(docker-run) php-cli
composer = $(php-cli) composer

docker-compose-build:
	$(docker-compose) build

docker-compose-start:
	$(docker-compose) start

docker-compose-stop:
	$(docker-compose) stop

docker-compose-up:
	$(docker-compose) up -d

docker-compose-down:
	$(docker-compose) down

#node
node-terminal:
	$(node) /bin/bash
npm-build:
	$(node) npm run build
npm-start:
	$(node) npm run start

#php-cli
terminal:
	$(php-cli) /bin/bash

#composer
composer-install:
	$(composer) install
composer-outdated:
	$(composer) outdated --direct
composer-update:
	$(composer) update
composer-check:
	$(composer) check
composer-test:
	$(composer) test
composer-clear:
	$(composer) clear
composer-migrate:
	$(composer) app migrations:migrate
