# Hydroponics manager

The main goal is to provide a management system to handle with day-by-day hydroponics work.

- Create tanks and relate them with multiples Hydroponic Systems.
- Store and monitor important data: pH, EC, water flow, temperature of your tanks ans Systems.
- Create and monitor crops from the start to harvesting.
- Extract productivity reports and manage your costs.
- Associate events for crops loss, generating important BI info for improve your productivity.

# Remaining tasks to first tests

- Create Functional tests for all API endpoints. _(In progress)_
- Change API swagger and implementation to use [JsonApi](http://jsonapi.org)
- Create API for manage crops.
- Implement tank version when updating tanks.
- Create missing endpoints for manage relation between systems/greenhouses/tanks/plants/crops.
- Implement Event-bus to manage API requests using RabbitMQ.
- Create ElasticSearch mapping to persist data and provide BI information
- Create script to populate ElasticSearch based on database data.
- Create **Progressive Web Application** to provide UI to monitor system.
- Create authentication based on user/pass and JWT.
- ...More tasks will be added

## Requirements

- PHP 7.2.9+
- MySQL 5.7+
- Apache or Nginx webserver

## Installation

### Run docker

```
docker-compose up -d
```

### Run composer inside container

```
docker container exec -it hydroponics_app bash
composer install
```

### Create db scheme

**ATTENTION: It will delete your db and create new one with test entries**.

```
docker container exec -it hydroponics_app php db/recreate-dev.php
```

### To access the API

To access

```
127.0.0.1:8001/public
```
 
# API Docs

For API usages, please open the [swagger.yml](./swagger.yml) on [Swagger Online Editor](https://editor.swagger.io/).
 
## Development

It would be awesome some help with the project! To make easier the pull requests approval
as well thr development process, I suggest you to follow the project standard quality control.
We are current using:

- PHP Standards verification and Object Calisthenics
```
bin/phpcs src
bin/phpcs tests
bin/phpcbf src
bin/phpcbf tests
```
- PHP unit tests
```
bin/phpunit
```
- PHP unit tests / Code coverage (minimum 90%)
```
bin/phpunit --coverage-html=coverage
```

Before commit anything, please make sure all is passing:
