# API.executiveclasses.com.br

Projeto da API usada para os produtos da executive classes.

Desenvolvido em:

- PHP: **7.4**
- Laravel: **8.24**

Documentação do projeto: [Tettra - Executive Classes](https://app.tettra.co/teams/executive-classes/subcategories/53712)


## Pré requisitos

Criar as pastas do projeto e entrar nela

```bash
mkdir -p /srv/eclasses
cd /srv/eclasses
```

Instalar o Docker na máquina e obter o projeto do Docker

```bash
git clone git@github.com:executive-classes/docker.git docker
```

Rodar containers do Docker

```bash
cd /srv/eclasses/docker
docker-compose up
```

## Instalação

Obter projeto da API

```bash
cd /src/eclasses/
git clone git@github.com:executive-classes/api.git api
```

Entrar no container `ec-php`

```bash
docker exec -it ec-php /bin/bash
```

Entrar na pasta da api

```bash
cd api
```

Baixar as dependências

```bash
composer update
```

## Configuração

Gerar chave do projeto

```bash
php artisan key:generate
```

Configurar arquivo `.env`. Seguir exemplo em `.env.exemple`.