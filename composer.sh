#!/bin/bash

sudo docker run --rm --interactive --tty \
  --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp \
  --volume $PWD:/app \
  --user $(id -u):$(id -g) \
  composer $1
