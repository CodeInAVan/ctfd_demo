#!/bin/bash

docker build -t easyone .
docker run --restart=always -d --name easyone -p 8081:80 easyone
