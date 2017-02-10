Symfony Docker Bootstrap
========================

This repository contains a bootstrap installation of Symfony to get you started together with:

- **Symfony 3.2**: Uses the microframework and puts all classes and configuration inside `src/` without the need of a custom bundle
- **Docker setup**: it has a Mariadb, Nginx and PHP-FPM 7.1 container which can be started using `docker-compose`
- **Testsuite setup**: testsuite script which runs all tests and generates reports which can be used in Jenkins or other tools
- **Doctrine setup**: Doctrine is enabled by default and a temporary sqlite database is used for functional testing.
- **Xdebug**: Remote debugging is enabled on development mode

New Project
===========

Setup new project directory

```bash
docker run --rm -v $(pwd):/app composer/composer \
    create-project -s dev yoshz/symfony-docker-bootstrap project-dir
cd project-dir
```

Build Docker image

```bash
docker-compose build
```

Start containers

```bash
docker-compose up -d
```

Create database schema

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

PHPStorm
--------

Make sure you installed the EditorConfig plugin.

To **Start listening for PHP Debug Connections** (the topright phone icon) make sure you have configured a PHP Server
called "docker" and add mapping on the root of project to `/var/www`.
