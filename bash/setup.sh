# pre-pull images
apt-get install git net-tools -y
mkdir /usr/local/cftdemo
cd /usr/local/cftdemo

git clone https://github.com/CodeInAVan/ctfd_demo
cd ctfd_demo

apt-get update -y
apt-get install -y apt-transport-https ca-certificates curl gnupg lsb-release
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

apt-get update -y

# install docker
apt-get install -y docker-ce docker-ce-cli containerd.io

# install docker compose
curl -L "https://github.com/docker/compose/releases/download/1.26.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

# pre-pull images
docker pull nginx:stable
docker pull mariadb:10.4.12
docker pull redis:4
docker pull bkimminich/juice-shop

# create secret
head -c 64 /dev/urandom > .ctfd_secret_key

# run certbot init
sudo chmod +x init-letsencrypt.sh
sudo ./init-letsencrypt.sh

# run the containers
docker-compose up -d

