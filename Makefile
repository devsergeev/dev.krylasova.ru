npm-build:
	docker-compose -f ./docker/docker-compose.yml exec node npm run build

npm-start:
	docker-compose -f ./docker/docker-compose.yml exec node npm run start
