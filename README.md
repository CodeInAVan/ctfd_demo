There are three steps to installing this application
1. Spin up the Scoreboard system (aka ctfd.io) and challenge servers via docker-compose
2. Import the challenges into the CTFd platform

* This guide assumes you are instllating into a newly installed Debian based ditro such as Ubuntu.
* The repository contains both the setup guide (the ReadMe you are reading now) and the actual software for the installation.

# Clone the Repo to your new Linux box.
```
sudo apt-get install git net-tools
git clone https://github.com/UKNorthernlad/juiceboxctf/
cd juicebox
```

# The Scoreboard
ctfd.io is a platform for keeping the scope for Capture The Flag type events. Once installed you can install separate standalone challenges which run in their own docker containers.

## Install Required packages and signing keys for Docker
```
sudo apt-get update -y
sudo apt-get install -y apt-transport-https ca-certificates curl gnupg lsb-release
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

sudo echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

sudo apt-get update -y
```

## Install Docker & run test container
```
sudo apt-get install -y docker-ce docker-ce-cli containerd.io
sudo docker run hello-world
```

## Download Docker Compose
```
sudo curl -L "https://github.com/docker/compose/releases/download/1.26.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

## Create a secret key
This is used as a salt for the generated flags to make them unique to this installation.
```
head -c 64 /dev/urandom > .ctfd_secret_key
```

## Start the service up in "interactive" mode
This will allow you to watch all the output & errors from the containers in real time.
```
sudo docker-compose up
```
> Wait about 5 minutes as it takes time for the various containers to start and for database tables and caches to be initialized and for the nginx proxy to start.
>
> Once complete, should now be able to access the Scoreboard service on http://localhost:8000

# Import the Challenge definition
* This will import the .zip file created previously into the Scoreboard system.
* It contains the information about all the bugs in the Juice Shop site.
* Provides a menu of different challenges to select from inside the scoreboard system - the only downside the challenges don't have URLs provided :(

1. Open the browser to the ctfd homepage (http://localhost or http://localhost:8000), then browse to Config ->  Backup -> Import and select the `CTFd-2022-XXXXXX.zip` file from the root of the `juiceboxctf` folder.

## The following are useful if you need to reset the score system
### Stop the service
* A simple ctrl-C in the terminal from where you ran "docker-compose up" will stop all containers.
* Use "docker-compose up" to re-start everything again.
* As an alternative from another window: `docker-compose down`

### Reset the application back to this point
If you ever need to reset the scoreboard environment right back to the beginning, run the following from the "juiceboxctf" directory:
```
sudo docker-compose down
sudo docker rm -f $(docker ps -a -q)
sudo docker volume prune
rmdir .data
```
