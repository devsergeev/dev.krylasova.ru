npm-run-build:
	docker-compose -f ./docker/docker-compose.yml run node npm run build

npm-run-start:
	docker-compose -f ./docker/docker-compose.yml run node npm run start
