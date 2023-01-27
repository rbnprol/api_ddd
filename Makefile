.PHONY: build
build: build start install
#create migrate

.PHONY: install
install: composer.lock composer install

#.PHONY: install
#install: composer-install

#.PHONY: composer-install composer-update
#composer-install: CMD=install
#composer-update: CMD=update
#composer-install composer-update:
#             @composer $(CMD)

.PHONY: start stop destroy build
start: CMD=up -d
stop: CMD=stop
destroy: CMD=down
build: CMD=build

start stop destroy:
	@docker-compose $(CMD)

.PHONY: create
create:
	bin/console doctrine:database:create --if-not-exists


.PHONY: migrate
migrate:
		bin/console make:migration
		bin/console doctrine:migrations:migrate
