# Dating API

## Features
- create random users
  - /api/v1/user/random
- find matches
  - /api/v1/matches
    - should exclude already matched users
  

## Authentication
Using [JWT RFC 7519](https://datatracker.ietf.org/doc/html/rfc7519)

Login with email and password auth should return JWT
 - /api/v1/user/login

## Filtering
 - age
 - gender
 - location

## User Management
 - profile picture
 - bio
 - location
 - age/d.o.b
   - could build feature around star sign matching