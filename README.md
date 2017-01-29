Symfony Docker Bootstrap
========================

This repository contains an installation of Symfony together with Docker to get you started.

Development
===========

Clone this repository.

Install vendor packages

```bash
docker run --rm -v $(pwd):/app composer/composer install
```

Build Docker image

```bash
docker-compose build
```

Start containers

```bash
docker-compose up -d
```

Create schema

```bash
docker-compose exec app bin/console doctrine:schema:create
```

Usage
-----

Run console commands

```bash
docker-compose exec app bin/console
```

Run testsuite (reports will be written to `reports` directory)

```bash
docker-compose exec app bin/testsuite
```

