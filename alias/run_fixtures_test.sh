#!/usr/bin/env bash
php ../bin/console doctrine:database:drop --force --env=test && php ../bin/console doctrine:database:create  --env=test &&  php ../bin/console doctrine:schema:update --force --env=test && php ../bin/console doctrine:fixture:load --env=test
