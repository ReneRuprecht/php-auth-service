# PHP Auth Service

![CI](https://github.com/reneruprecht/php-auth-service/actions/workflows/test.yml/badge.svg)

Ein schlanker Authentifizierungs-Service auf Basis von Symfony.

Funktionen:
- Benutzerregistrierung
- Passwort-Hashing
- Login, Jwt response
- Jwt Validierung
- Use-Case basierte Architektur
- PostgreSQL + Doctrine

## Architektur

Das Projekt folgt einer klaren Schichtenarchitektur:

- Domain, Business Logik
- Application, Use Cases
- Infrastructure, Doctrine / DB / HTTP

## Voraussetzungen

### Lokal
- Docker
- Docker Compose

### Container
- PHP 8.5
- Composer
- PostgreSQL

## Installation

```bash
git clone 

make up
```

## API

### health

GET /health

Response:
```json
{
  "status": "ok",
  "service": "auth-service",
  "timestamp": 1778410549
}
```

### register
POST /api/v1/register

Request:
```json
{
    "email": "email@example.com",
    "password": "password"
}
```

Response:
```json
{
    "status": "created"
}
```

### login
POST /api/v1/login

Request:
```json
{
    "email": "email@example.com",
    "password": "password"
}
```

Response:
```json
{
    "token": "jwt"
}
```

### verify
POST /api/v1/verify

Request:
```json
{
    "token": "email@example.com"
}
```

Response:
```json
{
    "valid": "true|false",
    "userID": "id",
    "email": "email"
}
```

## Backend Tests ausführen

Application und Integration Tests brauchen die Test-DB.
Die kann im Hauptordner mit `make test-db-up` gestartet werden.

```bash
make test-unit
make test-application
make test-integration
```


## Makefiles
### Makefile
```bash
make up             Start dev environment
make down           Stop containers
make clean          Stop containers and remove volumes
make app-shell      Open shell in app container
make test-db-up     Start test db
make test-db-reset  Clean test db volume
```

### Backend/Makefile
```bash
make db-migrate            run db migrations
make test-unit             run unit tests
make test-application      run application tests
make test-integration      run integration tests
make test-db-migrate       run test db migrations
make phpstan               run phpstan analyze src tests
make cf-fix                run cs-fixer fix
make cf-diff               run cs-fixer fix --dry-run --diff
make check                 run phpstan, cf-diff
```

## CI 

Die Pipeline besteht aus:

- Quality Stage (PHPStan + CS Fixer)
- Unit Tests
- Application Tests
- Integration Tests (PostgreSQL)
