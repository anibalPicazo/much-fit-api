#!/usr/bin/env bash
php ../bin/console doctrine:database:drop --force && php ../bin/console doctrine:database:create &&  php ../bin/console doctrine:schema:update --force && php ../bin/console doctrine:fixture:load -v
