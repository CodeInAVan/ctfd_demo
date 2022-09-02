#!/bin/bash

docker build -t querystrings .
docker run --restart=always -d --name querystrings -p 8087:80 querystrings
