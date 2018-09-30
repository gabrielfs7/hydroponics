# Hydroponics manager

The main goal is to provide a management system to handle with day-by-day hydroponics work.

- Create tanks and relate them with multiples Hydroponic Systems.
- Store and monitor important data: pH, EC, water flow, temperature of your tanks ans Systems.
- Create and monitor crops from the start to harvesting.
- Extract productivity reports and manage your costs.
- Associate events for crops loss, generating important BI info for improve your productivity.

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

Go inside the container:

```
docker container exec -it hydroponics_app bash
```

Create database: 

```
mysql -h hydroponics_mysql -u root -proot < db/create-database.sql
bin/doctrine orm:schema-tool:create
```

Initialize DB for development:

```
mysql -h hydroponics_mysql -u root -proot < db/init-dev.sql
```

### To access the API

To access

```
127.0.0.1:8001/public
```
 
## Development

It would be awesome some help with the project! To make easier the pull requests approval
as well thr development process, I suggest you to follow the project standard quality control.
We are current using:

- Cyclomatic mess detection
```
bin/quality-control/md.sh
```
- PHP Standards verification and Object Calisthenics
```
bin/quality-control/cs.sh
```
- PHP unit tests
```
bin/quality-control/test.sh
```
- PHP unit tests / Code coverage (minimum 90%)
```
bin/quality-control/test-coverage.sh
```
- PHP Metrics
```
bin/quality-control/phpmetrics.sh
```

Before commit anything, please make sure all is passing:
