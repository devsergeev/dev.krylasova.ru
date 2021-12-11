docker-exec = docker-compose -f ./docker/docker-compose.yml exec
node = $(docker-exec) node

node-terminal:
	$(node) /bin/bash

npm-build:
	$(node) npm run build

npm-start:
	$(node) npm run start

php-apache = $(docker-exec) php-apache
php-apache-terminal:
	$(php-apache) /bin/bash

composer = $(php-apache) composer

composer-check:
	$(composer) check

composer-app:
	$(composer) app $(arg)
