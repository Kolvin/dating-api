# Local Environment Visual
![Alt text](.docker/dev-env-visual.png?raw=true "Optional Title")


# Prerequisites

- [Docker](https://docs.docker.com/get-docker/) + [Docker Compose](https://docs.docker.com/compose/install/) are required to run the project
  
- Create a new entry in ```/etc/hosts ```  ```127.0.0.1 dev.dating.api```

# Starting the project

```
cp .env.example .env
docker-compose up -d  
```


# Execute Service Commands
```
docker-compose exec <service> <command>

ie: docker-compose exec core bin/console ca:cl
```

# Testing
#### Run entire suite

```
docker-compose exec core composer test
```

#### Run Functional Suite
```
 docker-compose exec core vendor/bin/simple-phpunit --testsuite Functional
```

#### Run Unit Suite
```
 docker-compose exec core vendor/bin/simple-phpunit --testsuite Unit
```


# QA Standards
#### [Lint](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
```
docker-compose exec core composer lint
``` 
#### [Static Analysis](https://github.com/phpstan/phpstan)
```
docker-compose exec core composer stan
``` 

# Pre commit checks
- Executes all test suites
- Executes static analysis
- Executes linter
```
docker-compose exec core composer pre-commit
```