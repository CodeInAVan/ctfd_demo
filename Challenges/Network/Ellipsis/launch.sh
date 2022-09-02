#!/bin/bash

docker build -t timetrial .
docker run --restart=always -d --name ellipsis -p 8095:80 ellipsis
