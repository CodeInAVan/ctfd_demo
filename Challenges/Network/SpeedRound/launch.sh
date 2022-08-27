#!/bin/bash

docker build -t speedround .
docker run --restart=always -d --name speedround -p 10001:10001 speedround
