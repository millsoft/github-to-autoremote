# GitHub to Autoremote

This is a simple webhook that receives GitHub pushes and sending them to AutoRemote.

## Usage

- create a new `.env` file and enter there your AutoRemote API key (see `.env.example` for example)
- upload this project somewhere so GitHub can access it. (I tested it with php 7.3)
- install all libraries by executing `composer install`
- create a webhook in GitHub for the push event in one or multiple of your projects:
  - Payload URL = point to the index.php
  - Content Type os `application/json`
  - Secret = empty
  - Which event? = Just the push event


## Test if AutoRemote is working

Open the page `index.php?__hook=test`. It should send you a small test message.

## About
Project by MilMike 2020.