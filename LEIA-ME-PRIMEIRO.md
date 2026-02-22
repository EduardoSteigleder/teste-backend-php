# Antes de qualquer coisa

Se você quer ver a API rodando agora, é simples.

## Subir o projeto

Na raiz do backend, execute:

```bash
docker compose up -d --build
```

Aguarde a build (normalmente 20 a 30 segundos).

Depois disso, a API estará disponível em:

[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Teste rápido

Sincronizar produtos:

```bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/produtos
```

Sincronizar preços:

```bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/precos
```

Listar produtos:

```bash
curl "http://127.0.0.1:8000/api/produtos-precos"
```

---

## Rodar os testes

```bash
docker compose exec app php artisan test
```

Se tudo estiver certo, os testes passam normalmente.

---

## O que você precisa

* Docker instalado
* Docker Compose funcionando

Nada de PHP, Composer ou banco instalado na máquina.

---

## Estrutura principal

Os pontos mais importantes do projeto:

* `app/` → código da aplicação
* `database/` → migrations, seeds e views
* `routes/api.php` → definição dos endpoints

---

## Se algo não funcionar

Porta 8000 ocupada?
Edite o `docker-compose.yml` e altere para algo como:

```
ports:
  - "8001:8000"
```

Depois acesse [http://127.0.0.1:8001](http://127.0.0.1:8001)

Containers com problema?

```bash
docker compose down -v
docker compose up -d --build
```

Testes falhando?

```bash
docker compose exec app php artisan migrate:refresh --seed
docker compose exec app php artisan test
```

---

## Dados de exemplo

Após sincronizar, você deve ver apenas os produtos ativos:

* PROD001 – PRODUTO A – 100.50
* PROD002 – PRODUTO B – 250.75
* PROD004 – PRODUTO D – 150.25

(PROD003 está inativo e não aparece)

---

## Resumo rápido

```
docker compose up -d --build   → sobe tudo
curl http://127.0.0.1:8000/... → testa
docker compose logs            → vê logs
docker compose down            → para
```
