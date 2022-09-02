#!/bin/bash

docker build -t simpleweblogin .
docker run --restart=always -d --name simpleweblogin -p 8084:80 simpleweblogin
