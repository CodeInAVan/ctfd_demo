#!/bin/bash

docker build -t alphatesting .
docker run --restart=always -d --name alphatesting -p 8080:80 alphatesting
