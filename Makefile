# make for windows http://gnuwin32.sourceforge.net/packages/make.htm
DC = docker-compose
CERT_DIR = ./docker/nginx/cert
COMPOSER = $(DC) exec app composer

##help			Shows this help
help:
	@cat makefile | grep "##." | sed '2d;s/##//;s/://'

##install			Initial setup of application with autostarting containers
install: dhparam cert up composer init migrate generate-vacancy

##start			Start containers with checking certificate expires
start: dhparam cert up

##stop			Down containers (down alias)
stop: down

##migrate			Run migrations
migrate:
	$(DC) exec app php yii migrate

##init			Run migrations
init:
	$(DC) exec app php yii environment/init

##generate-vacancy			Run migrations
generate-vacancy:
	$(DC) exec app php yii vacancy/generate

##cert			Create/renew certificate
cert:
	@if ! openssl x509 -checkend 86400 -noout -in $(CERT_DIR)/localhost.crt; then\
		echo -e "Certificate not found or has expired or will do so within 24 hours!";\
		echo -e "New certificate will be generated here.";\
		echo -e "In common case you will need to press \"Enter\" key a few times.";\
		openssl req -x509 -nodes -days 1825 -newkey rsa:2048 -keyout $(CERT_DIR)/localhost.key -out $(CERT_DIR)/localhost.crt -config $(CERT_DIR)/localhost.conf;\
	fi;\

##dhparam			Generate dhparam.pem if it is not exists
dhparam:
	@if [ ! -f $(CERT_DIR)/dhparam.pem ]; then\
		openssl dhparam -out $(CERT_DIR)/dhparam.pem 2048;\
	fi;\

##bash			Open the app container bash
bash:
	$(DC) exec app bash

##up			Up containers with rebuild
up:
	$(DC) up --build -d

##composer		Install composer requirements
composer:
	$(COMPOSER) install

##down			Down containers
down:
	$(DC) down

##test			Run tests
test:
	$(DC) exec app ./vendor/bin/phpunit

##test-coverage		Run tests with coverage
test-coverage:
	$(DC) exec app ./vendor/bin/phpunit --coverage-html ./public/coverage/

##load			Dump the autoloader
load:
	$(COMPOSER) dumpautoload

##ps			Show runned containers
ps:
	$(DC) ps

##require			Require composer dependency
require:
	$(COMPOSER) require $(filter-out $@,$(MAKECMDGOALS))

##remove			Remove composer dependency
remove:
	$(COMPOSER) remove $(filter-out $@,$(MAKECMDGOALS))

%:#Dyrty hack for replace original behavior with goals
	@:
