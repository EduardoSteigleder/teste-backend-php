# Teste Técnico – Desenvolvedor PHP (Laravel)

## Sobre o projeto

Esse projeto é uma API em Laravel responsável por processar e sincronizar dados de produtos e preços.

A ideia principal foi utilizar Views SQL para centralizar a regra de transformação dos dados, deixando a sincronização mais simples e organizada.

Não existe interface web. É somente API.

---

## Tecnologias utilizadas

* PHP 8.2
* Laravel 11
* SQLite
* Docker
* Docker Compose

---

## O que o projeto atende

* Roda 100% via Docker
* Possui docker-compose.yml
* Expõe apenas endpoints REST
* Tem testes automatizados
* Não precisa instalar PHP ou Composer na máquina
* Não possui interface gráfica

---

## Como rodar

### Pré-requisito

Ter Docker instalado e rodando.

### Subir o projeto

Na raiz do backend:

```bash
docker compose up -d --build
```

A API ficará disponível em:

[http://127.0.0.1:8000](http://127.0.0.1:8000)

### Parar os containers

```bash
docker compose down
```

### Ver logs

```bash
docker compose logs -f app
```

---

## Endpoints

### Sincronizar produtos

POST `/api/sincronizar/produtos`

Executa a sincronização da tabela `produtos_base` para `produto_insercao`, consumindo os dados já normalizados pela view.

```bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/produtos
```

---

### Sincronizar preços

POST `/api/sincronizar/precos`

Sincroniza `precos_base` com `preco_insercao`, também utilizando a view como origem.

```bash
curl -X POST http://127.0.0.1:8000/api/sincronizar/precos
```

---

### Listar produtos com preços (paginado)

GET `/api/produtos-precos`

Parâmetros opcionais:

* `page` (padrão: 1)
* `per_page` (padrão: 10, máximo: 100)

Exemplo:

```bash
curl "http://127.0.0.1:8000/api/produtos-precos?page=1&per_page=10"
```

---

## Estrutura do banco

### Tabelas de origem

* `produtos_base`
* `precos_base`

### Tabelas de destino

* `produto_insercao`
* `preco_insercao`

As tabelas de destino recebem apenas dados normalizados.

---

## Views SQL

As views são responsáveis pela transformação dos dados.

### view_produtos_processados

* Converte nome e descrição para maiúsculo
* Remove espaços
* Considera apenas registros ativos

### view_precos_processados

* Arredonda preço para 2 casas
* Normaliza moeda
* Considera apenas registros ativos

A sincronização consome apenas essas views.

---

## Como funciona a sincronização

A regra implementada segue essa lógica:

1. Lê os dados já tratados pelas views
2. Insere novos SKUs
3. Atualiza registros que sofreram alteração
4. Remove registros que deixaram de existir na view
5. Evita duplicidade
6. Só atualiza quando realmente há mudança

Tudo é feito com transaction para manter integridade.

---

## Testes

Os testes cobrem:

* Sincronização de produtos
* Sincronização de preços
* Paginação
* Reexecução sem duplicidade
* Processamento apenas de registros ativos

Para rodar:

```bash
docker compose exec app php artisan test
```

---

## Seed de exemplo

O projeto já sobe com dados de teste:

Produtos ativos e inativos
Preços ativos e inativos

Isso facilita validar o comportamento da sincronização.

---

## Comandos úteis

Rodar migrations:

```bash
docker compose exec app php artisan migrate
```

Rodar seed:

```bash
docker compose exec app php artisan db:seed
```

Entrar no container:

```bash
docker compose exec app bash
```

---

## Observações

* O `.env` está versionado apenas para facilitar execução
* O banco SQLite é criado automaticamente
* Migrations e seeds rodam no start do container
* Índices foram criados nas colunas de busca (sku)

---

## Status

Projeto funcional
Testes passando
Docker configurado
Pronto para avaliação
