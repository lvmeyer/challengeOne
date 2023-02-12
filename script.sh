#! /bin/bash
echo ECS_CLUSTER="challenge-one-cluster" >> /etc/ecs/ecs.config
sudo apt-get update
sudo apt-get install ca-certificates curl gnupg lsb-release

sudo mkdir -m 0755 -p /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg --yes
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

sudo apt-get update
sudo chmod a+r /etc/apt/keyrings/docker.gpg
sudo apt-get update

sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin --yes
sudo apt-get install docker-compose --yes

git clone https://github.com/DanLevyM/challengeOne.git aws_test
cd aws_test/

# sudo docker compose up -d
# sudo sleep 30
# sudo docker compose exec php bin/console doctrine:schema:update --force
# sudo docker-compose exec php sh -c '
#     set -e
#     apk add openssl
#     php bin/console lexik:jwt:generate-keypair
#     setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
#     setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
# ' 
# sudo docker-compose down
# sudo nohup docker-compose up -d