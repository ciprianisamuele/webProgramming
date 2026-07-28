# StudWeb Architecture

## Purpose

StudWeb is a local full-stack marketplace prototype. It connects users through profiles, geographically indexed listings, and direct messages.

## Main components

### Browser interface

The frontend is implemented with HTML, CSS, JavaScript, and jQuery. It is responsible for:

- rendering pages and navigation;
- collecting user input;
- submitting forms;
- issuing AJAX requests;
- displaying listings and images;
- loading map data;
- updating chat interfaces.

### PHP application layer

PHP scripts implement:

- session handling;
- registration and authentication;
- database access;
- listing publication;
- image-upload handling;
- search;
- user-profile operations;
- direct messaging.

### Database layer

MySQL stores application data such as:

- users;
- password hashes;
- profiles;
- listings;
- listing images;
- geographical coordinates;
- messages and conversation state.

Prepared statements are used in several database operations.

### External map services

Google Maps services provide:

- address geocoding;
- latitude and longitude lookup;
- map rendering;
- geographical display of listings.

## Typical listing workflow

```text
User completes listing form
        │
        ▼
JavaScript creates FormData
        │
        ▼
Address is geocoded
        │
        ▼
AJAX request is sent to PHP
        │
        ▼
PHP processes text and uploaded images
        │
        ▼
Listing and coordinates are stored in MySQL
        │
        ▼
Listing becomes available in search and map views
```

## Typical authentication workflow

```text
Registration form
        │
        ▼
PHP validates and normalises input
        │
        ▼
Password is hashed
        │
        ▼
User is stored in MySQL
        │
        ▼
PHP session is created
```

During login, the submitted password is checked against the stored hash and the authenticated user's details are stored in the session.

## Development constraints

The project was created as a self-directed local prototype. Consequently:

- configuration is oriented toward a local Apache/PHP/MySQL environment;
- some paths are tied to the original local directory structure;
- automated tests are not included;
- the original database dump is not currently part of the repository;
- production deployment and security hardening were outside the original scope.
