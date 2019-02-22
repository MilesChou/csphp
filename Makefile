#!/usr/bin/make -f

INSTALL_PATH := /usr/local/bin/csphp

.PHONY: all clean clean-all install

# ---------------------------------------------------------------------

all: clean csphp.phar

csphp.phar: composer.phar
	@php composer.phar install --optimize-autoloader
	@php -d phar.readonly=off ./scripts/build
	@chmod +x csphp.phar

clean:
	@echo Clean files
	@rm -f csphp.phar

clean-all: clean
	@rm -f composer.phar

install:
	mv csphp.phar ${INSTALL_PATH}

vendor: composer.phar
	php composer.phar install --no-dev

composer.phar:
	@echo Download composer.phar
	@curl -sS https://getcomposer.org/installer | php

image: csphp.phar
	docker build -t csphp .
