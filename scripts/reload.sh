#!/usr/bin/env bash

app/console doctrine:schema:drop --force
app/console doctrine:schema:update --force

