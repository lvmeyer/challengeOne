#! /bin/bash
echo ECS_CLUSTER="challenge-one-cluster" >> /etc/ecs/ecs.config
sudo apt-get update
sudo apt-get install ca-certificates curl gnupg lsb-release
sudo apt-get install docker-compose --yes
git clone https://github.com/DanLevyM/challengeOne.git aws_test
cd aws_test/
sudo docker compose up -d
sudo sleep 30
sudo docker compose exec php bin/console doctrine:schema:update --force
sudo docker compose exec php sh -c '
    set -e
    apk add openssl
    php bin/console lexik:jwt:generate-keypair
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
' 
sudo docker-compose down
sudo docker-compose up -d