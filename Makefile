.PHONY: build start stop renew test

build:
	docker compose build --pull --no-cache

start:
	docker compose up -d

stop:
	docker compose down

# Execute this after startclient and startserver if the bdd was updated - press "yes" for purge the dabatase and apply fixtures
renew:
	docker compose exec php bin/console doctrine:schema:update --force
	docker compose exec php bin/console doctrine:fixtures:load 

test:
	docker compose exec php bin/phpunit
	docker compose exec web npm run test