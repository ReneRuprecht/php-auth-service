.PHONY: help up down clean app-shell

COMPOSE = docker compose -f ./docker-compose.dev.yml

help:
	@echo " make up           Start dev environment"
	@echo " make down         Stop containers"
	@echo " make clean        Stop containers and remove volumes"
	@echo " make app-shell    Open shell in app container"

up:
	@echo "Starting dev environment"
	@${COMPOSE} up -d

down:
	@echo "Stopping containers"
	@${COMPOSE} down

clean:
	@echo "Stopping containers and removing volumes"
	@${COMPOSE} down -v

app-shell:
	@echo "Opening shell in app container"
	@${COMPOSE} exec app bash