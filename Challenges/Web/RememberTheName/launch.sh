#!/bin/bash

docker build -t rememberthename .
docker run --restart=always -d --name rememberthename -p 8083:80 rememberthename
