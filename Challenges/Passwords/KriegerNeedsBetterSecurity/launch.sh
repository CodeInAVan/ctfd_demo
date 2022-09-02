#!/bin/bash

docker build -t kriegerneedsbettersecurity .
docker run -d --name kriegerneedsbettersecurity -p 8085:80 kriegerneedsbettersecurity
