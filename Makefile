.PHONY: startclient startserver stopclient stopserver

startclient:
	docker-compose -f vite-vue/docker-compose.yml up -d

startserver:
	docker-compose up -d

stopclient:
	docker-compose -f vite-vue/docker-compose.yml down

stopserver:
	docker-compose down

