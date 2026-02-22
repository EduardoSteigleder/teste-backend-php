.PHONY: help build up down logs test migrate seed fresh

help:
	@echo "Comandos disponíveis:"
	@echo "  make build              - Build da imagem Docker"
	@echo "  make up                 - Inicia os containers"
	@echo "  make down               - Para os containers"
	@echo "  make logs               - Mostra logs em tempo real"
	@echo "  make test               - Executa os testes"
	@echo "  make migrate            - Executa migrations"
	@echo "  make seed               - Executa seeders"
	@echo "  make fresh              - Reset banco de dados (migrate + seed)"
	@echo "  make bash               - Acesso bash ao container"
	@echo "  make sync-produtos      - Sincroniza produtos"
	@echo "  make sync-precos        - Sincroniza preços"
	@echo "  make listar             - Lista produtos e preços"

build:
	docker compose build

up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f app

test:
	docker compose exec app php artisan test

migrate:
	docker compose exec app php artisan migrate

seed:
	docker compose exec app php artisan db:seed

fresh:
	docker compose exec app php artisan migrate:refresh --seed

bash:
	docker compose exec app bash

sync-produtos:
	curl -X POST http://127.0.0.1:8000/api/sincronizar/produtos

sync-precos:
	curl -X POST http://127.0.0.1:8000/api/sincronizar/precos

listar:
	curl -X GET "http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10"

tinker:
	docker compose exec app php artisan tinker
