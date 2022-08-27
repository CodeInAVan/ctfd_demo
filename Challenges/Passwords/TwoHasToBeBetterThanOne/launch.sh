#!/bin/bash

docker build -t twohastobebetterthanone .
docker run --restart=always -d --name twohastobebetterthanone -p 8086:80 twohastobebetterthanone
