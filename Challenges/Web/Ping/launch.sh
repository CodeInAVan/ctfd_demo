#!/bin/bash

docker build -t ping .
docker run --restart=always -d --name ping -p 8082:80 ping
