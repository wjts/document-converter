.PHONY: up destroy destroy-all build stop

up:
	docker-compose up -d

stop:
	docker-compose stop

destroy:
	docker-compose down

destroy-all:
	docker-compose down -v

build:
	docker-compose up -d --build --force-recreate

