.PHONY: startclient startserver stopclient stopserver

startclient:
	docker-compose -f vite-vue/docker-compose.yml up -d

startserver:
	docker-compose up -d

stopclient:
	docker-compose -f vite-vue/docker-compose.yml down

stopserver:
	docker-compose down

# Execute this after startclient and startserver if the bdd was updated - press "yes" for purge the dabatase and apply fixtures
renew:
	docker compose exec php bin/console doctrine:schema:update --force
	docker compose exec php bin/console doctrine:fixtures:load 

