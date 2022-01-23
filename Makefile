docker-exec = docker-compose -f ./docker/docker-compose.yml exec
docker-run = docker-compose -f ./docker/docker-compose.yml run --rm
php-apache = $(docker-exec) php-apache
node = $(docker-exec) node
php-cli = $(docker-run) php-cli
composer = $(php-cli) composer

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
install:
	$(composer) install
outdated:
	$(composer) outdated --direct
update:
	$(composer) update
check:
	$(composer) check
test:
	$(composer) test
clear:
	$(composer) clear
migrate:
	$(composer) app migrations:migrate
