#!/bin/bash

# Stop and remove only the app container
docker-compose stop app
docker-compose rm -f app

# Rebuild and start only the app service
docker-compose up -d --build app

# Display the logs
docker-compose logs -f app

# docker-compose down
# docker-compose build
# docker-compose up -d



# # docker-compose down
# # docker-compose build
# # docker-compose up -d
