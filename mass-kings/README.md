# Mass-Kings 1.0

## Introduction
This PHP based backend just handles creating appointments, no additional features.

## Installation

 1. `export DATABASE_URL=<database-dsn>`
 2. `symfony console doctrine:migrations:migrate`
 3. `export APP_ENV=prod`
 4. `symfony console cache:warmup`
 5. Setup NGINX + PHP-FPM.
 6. (Optionally) Configure TLS.

## Specs

 - PSR4
 - PSR12

