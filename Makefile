# VARIABLES
ENV_FILE	   = .docker/.env
DOCKER_COMPOSE = docker compose
CONTAINER_SUFFIX = projections
PORT_HTTP_EXTERNAL = $(shell source $(ENV_FILE); echo $$PORT_HTTP_EXTERNAL)
PORT_HTTP_INTERNAL = $(shell source $(ENV_FILE); echo $$PORT_HTTP_INTERNAL)
CONTAINER      = webserver
EXEC           = docker exec -t --user=root $(CONTAINER)-$(CONTAINER_SUFFIX)
EXEC_TI        = docker exec -ti --user=root $(CONTAINER)-$(CONTAINER_SUFFIX)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer
CURRENT-DIR  := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
CURRENT_UID  := $(shell id -u)

define EXPORT_ENV_VARS
export CONTAINER_SUFFIX=$(CONTAINER_SUFFIX); \
export PORT_HTTP_EXTERNAL=$(PORT_HTTP_EXTERNAL); \
export PORT_HTTP_INTERNAL=$(PORT_HTTP_INTERNAL);
endef


.DEFAULT_GOAL := deploy

.PHONY: deploy build deps update-deps composer-install ci composer-update cu composer-require cr composer start stop down recreate rebuild test reload clear bash style lint lint-diff static-analysis

deploy: build
	@echo "📦 Build done"

build: create_env_file rebuild

# 🚚 Dependencies
deps: composer-install

update-deps: composer-update

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi
# 🐘 Composer
composer-install ci: ACTION=install

composer-update cu: ACTION=update $(module)

composer-require cr: ACTION=require $(module)

composer composer-install ci composer-update composer-require cr: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi
# 🐳 Docker Compose
start: create_env_file
	@echo "🚀 Deploy!!!"
	@$(DOCKER_COMPOSE) up -d
stop:
	$(DOCKER_COMPOSE) stop
down:
	$(DOCKER_COMPOSE) down
recreate:
	@echo "🔥 Recreate container!!!"
	@$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	make deps
rebuild:
	@echo "🔥 Rebuild container!!!"
	@$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make start
	make deps

# 🧪 Tests
test: create_env_file
	$(EXEC)  ./vendor/bin/phpunit --no-coverage

test/coverage: create_env_file
	$(EXEC)  ./vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml --order-by=random

# 🦝 Apache
reload:
	$(EXEC) /bin/bash service apache2 restart || true

# 🧹 Clear cache
clear:
	$(SYMFONY) cache:clear

# 🐚 Shell
bash:
	$(EXEC_TI) /bin/bash

# 🦊 Linter
style: lint static-analysis
lint:
	$(EXEC) ./vendor/bin/php-cs-fixer fix --diff
	@echo "Coding Standar Fixer Executed ✅"

lint-diff:
	$(EXEC)  ./vendor/bin/php-cs-fixer fix --dry-run --diff
	@echo "Coding Standar Fixer Executed ✅"

static-analysis:
	$(EXEC)  ./vendor/bin/phpstan analyse -c phpstan.neon.dist

rm-database:
	@docker-compose rm -f database
compose: stop rm-database
	@docker-compose up -d --force-recreate database

create-db: create-db/dev create-db/test
create-db/dev:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:database:create --env=dev --no-interaction --if-not-exists
create-db/test:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:database:create --env=test --no-interaction --if-not-exists

migrate: migrate/dev migrate/test
migrate/dev:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:migrations:migrate --env=dev

migrate/test:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:migrations:migrate --env=test

migration/diff:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:migrations:diff

migration/gen:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:migrations:generate

drop-db: drop-db/dev  drop-db/test
drop-db/dev:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:database:drop --force --env=dev --if-exists
drop-db/test:
	@docker exec $(CONTAINER)-$(CONTAINER_SUFFIX) php bin/console doctrine:database:drop --force --env=test --if-exists