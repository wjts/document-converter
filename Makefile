.PHONY: up destroy destroy-all build

up:
	docker-compose up -d

destroy:
	docker-compose down

destroy-all:
	docker-compose down -v

build:
	docker-compose up -d --build --force-recreate
