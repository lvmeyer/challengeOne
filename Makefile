.PHONY: startclient startserver stopclient stopserver

start:
	docker-compose up -d

stop:
	docker-compose down

# Execute this after startclient and startserver if the bdd was updated - press "yes" for purge the dabatase and apply fixtures
renew:
	docker compose exec php bin/console doctrine:schema:update --force
	docker compose exec php bin/console doctrine:fixtures:load 

