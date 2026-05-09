.PHONY: help up down clean app-shell test-db-reset test-db-up

COMPOSE = docker compose -f ./docker-compose.dev.yml

help:
	@echo " make up           Start dev environment"
	@echo " make down         Stop containers"
	@echo " make clean        Stop containers and remove volumes"
	@echo " make app-shell    Open shell in app container"

up:
	@echo "Starting dev environment"
	@${COMPOSE} up -d app db nginx

down:
	@echo "Stopping containers"
	@${COMPOSE} down

clean:
	@echo "Stopping containers and removing volumes"
	@${COMPOSE} down -v

app-shell:
	@echo "Opening shell in app container"
	@${COMPOSE} exec app bash

test-db-up:
	docker compose -f ./docker-compose.dev.yml up -d db_test

test-db-reset:
	docker compose -f ./docker-compose.dev.yml down -v db_test
	docker compose -f ./docker-compose.dev.yml up -d db_test

