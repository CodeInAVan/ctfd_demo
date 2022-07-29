There are three steps to installing this application
1. Install the Scoreboard system (aka ctfd.io)
1. Install the buggy website that students will attack (aka The Juice Shop Challenges)
1. Import into the Scoreboard the information about each of the bugs for users to choose a challenge.

# The Scoreboard
ctfd.io is a platform for keeping the scope for Capture The Flag type events. Once installed you can install separate standalone challenges which run in their own docker containers.

## Install Required packages and signing keys for Docker
```
apt-get update -y
apt-get install -y apt-transport-https ca-certificates curl gnupg lsb-release
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

apt-get update -y
```

## Install Docker & run test container
```
apt-get install -y docker-ce docker-ce-cli containerd.io
docker run hello-world
```

## Install Git and other tools
```
apt-get install git net-tools
git clone https://github.com/CTFd/CTFd.git 
cd ctfd
docker build .
```

## Download Docker Compose
```
curl -L "https://github.com/docker/compose/releases/download/1.26.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose
```

## Pre-pull all the images needed
These aren't really needed here as docker-compose will do it for us if we ommit them here.
```
docker pull nginx:stable
docker pull mariadb:10.4.12
docker pull redis:4
```

## Create a secret key
This is used as a salt for the generated flags to make them unique to this installation.
```
head -c 64 /dev/urandom > .ctfd_secret_key
```

## Start the service up in "interactive" mode
This will allow you to watch all the output & errors from the containers in real time.
```
docker-compose up
```
> Wait about 2 minutes as it take time for the various containers to start and for database tables and caches to be initialized and for the nginx proxy to start.
> 
> You should now be able to access the service on http://localhost:8000
> 
> The result should look like this:

TODO: Add picture

# Configure the Service
* Enter an "Event Name" of "Training".
* For "Mode" choose "User"
* For "Administration" enter "admin" for the username, "admin@admin.admin" for the email & "admin" for the password.

> Configuration of the scoreboard ctfd is now complete. Move onto Install the "Juice Shop".

## The following are useful if you need to reset the score system 
### Stop the service
* A simple ctrl-C in the terminal from where you ran "docker-compose up" will stop all containers.
* Use "docker-compose up" to re-start everything again.
* As an alternative from another window: `docker-compose down`

### Reset the application back to this point
If you ever need to reset the scoreboard environment right back to the beginning, run the following from the "ctfd" directory:
```
docker-compose down
docker rm -f $(docker ps -a -q)
docker volume prune
rmdir .data
```

# Install the "Juice Shop".
This is a set of hacking challenges which target the OWASP Top 10 vulnerabilities. It's the world's most modern yet insecure website!
Reference - https://owasp.org/www-project-juice-shop/
Reference - https://pwning.owasp-juice.shop/
Reference - Answers to challenges -> https://www.youtube.com/watch?v=AIUhCdOMrmc

## Download the docker image.
This is a pre-build image of the main content at https://github.com/juice-shop/juice-shop
```
docker pull bkimminich/juice-shop
```

## Run the image
```
docker run --rm -e "NODE_ENV=ctf" -p 3000:3000 bkimminich/juice-shop
```
> Open a browser to http://localhost:3000 to view the site.


# Import the Juice Box Challenge definitions into the ctfd score board system
Reference - https://github.com/juice-shop/juice-shop-ctf
This will provide a menu of different challenges to select from inside the scoreboard system - the only downside the challenges don't have URLs provided :( 

```
apt-get install -y npm
npm install -g juice-shop-ctf-cli
```

## Run the application
Accept the default options for the first 3 questions (CTFd, JuiceShopURL, SecretKey) then choose the "Free" option for the next three.
```
juice-shop-cli
```

> Once completed, you will file a file called "OWASP_Juice_Shop.xxxx-xx-xx.CTFd.zip" in the local folder.


> Open the browser to the ctfd homepage, then browse to Config ->  Backup -> Import and select .zip file created above.

# It looks like this:

TODO: Add image

> Once the data is imported, you should see the following:

TODO: Add image

# References
* https://docs.ctfd.io/docs/deployment/installation
* Setup Guide for AWS - https://www.doyler.net/security-not-included/owasp-juice-shop-ctfd
