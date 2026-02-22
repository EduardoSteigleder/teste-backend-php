# Início Rápido

Este é o guia mais direto para rodar o projeto e testar a API.

------------------------------------------------------------------------

## 1. Subir o projeto

No terminal, dentro da pasta do projeto:

``` bash
docker compose up -d --build
```

A aplicação ficará disponível em:

http://127.0.0.1:8000

------------------------------------------------------------------------

## 2. Testar os endpoints

Você pode usar cURL, Postman ou qualquer cliente HTTP.

### Sincronizar produtos

``` bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/produtos
```

### Sincronizar preços

``` bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/precos
```

### Listar produtos com preços (paginado)

``` bash
curl "http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10"
```

------------------------------------------------------------------------

## 3. Rodar os testes automatizados

``` bash
docker compose exec app php artisan test
```

------------------------------------------------------------------------

## Banco de Dados

Executar migrations:

``` bash
docker compose exec app php artisan migrate
```

Executar seed:

``` bash
docker compose exec app php artisan db:seed
```

Reset completo (apaga, recria e popula):

``` bash
docker compose exec app php artisan migrate:refresh --seed
```

------------------------------------------------------------------------

## Acessar o container

Se precisar executar algo manualmente:

``` bash
docker compose exec app bash
```

------------------------------------------------------------------------

## Ver logs

``` bash
docker compose logs -f app
```

------------------------------------------------------------------------

## Parar o projeto

``` bash
docker compose down
```

------------------------------------------------------------------------

Para mais detalhes sobre arquitetura, decisões técnicas e exemplos
completos, consulte o README.md.
