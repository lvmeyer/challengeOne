.PHONY: startclient startserver stopclient stopserver restartclient restartserver start stop

startclient:
	docker-compose -f vite-vue/docker-compose.yml up -d

startserver:
	docker-compose up -d

stopclient:
	docker-compose -f vite-vue/docker-compose.yml down

stopserver:
	docker-compose down

restartclient:
	stopclient startclient

restartserver:
	stopserver startserver

start:
	startclient startserver

stop:
	stopclient stopserver