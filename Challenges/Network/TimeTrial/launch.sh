#!/bin/bash

docker build -t timetrial .
docker run --restart=always -d --name timetrial -p 8088:80 timetrial
