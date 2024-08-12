# Makefile for managing Docker Compose and Laravel commands

# Set default user ID and username if not provided
USERID ?= $(shell id -u)
USER ?= $(shell id -un)

# Default target to start the project
.PHONY: start
start: copy-env stop build up install-deps migrate queue

# Target to copy environment files
.PHONY: copy-env
copy-env:
	cp -n ./application/.env.example ./application/.env || true
	cp -n .env.example .env || true

# Target to stop the services
.PHONY: stop
stop:
	docker-compose stop

# Target to build the services
.PHONY: build
build:
	docker-compose build --build-arg uid=$(USERID) --build-arg user=$(USER)

# Target to start the services
.PHONY: up
up:
	docker-compose up -d

# Target to install composer dependencies
.PHONY: install-deps
install-deps:
	docker-compose exec php composer install
	docker-compose exec php php artisan key:generate

# Target to run database migrations
.PHONY: migrate
migrate:
	docker-compose exec php php artisan migrate

# Target to start the queue worker
.PHONY: queue
queue:
	docker-compose exec -d php php artisan queue:work

# Target to run tests
.PHONY: test
test:
	docker-compose exec php php artisan test
