# Web Programming Projects

A collection of two full-stack web applications developed as self-directed learning projects using PHP, MySQL, HTML, CSS, and JavaScript.

The main project in this repository is **StudWeb**, a location-based marketplace prototype inspired by platforms that connect users through listings, maps, profiles, and direct messaging. The repository also contains an earlier **e-commerce prototype**, which documents my initial work with server-side development and relational databases.

> These projects were developed and tested locally with Apache, PHP, and MySQL. They are educational prototypes rather than production-ready services.

## Featured project: StudWeb

`studweb/` is the most complete application in the repository.

### Main features

- User registration and login
- Secure password hashing and verification
- Session-based authentication
- User profiles and profile images
- Creation of listings with descriptions, prices, addresses, and multiple images
- Address geocoding and map-based exploration
- Search and pagination interfaces
- Direct messaging between registered users
- MySQL persistence through PHP and MySQLi
- Asynchronous browser-server communication using JavaScript, jQuery, and AJAX

### Technology stack

| Layer | Technologies |
|---|---|
| Frontend | HTML5, CSS3, JavaScript, jQuery |
| Backend | PHP |
| Database | MySQL, MySQLi, prepared statements |
| Authentication | PHP sessions, `password_hash`, `password_verify` |
| External services | Google Maps JavaScript and Geocoding APIs |
| Local environment | Apache, PHP, MySQL |

### High-level architecture

```text
Browser
  ├── HTML / CSS
  ├── JavaScript and jQuery
  └── AJAX requests
          │
          ▼
PHP application
  ├── Authentication and sessions
  ├── Listing management
  ├── Image uploads
  ├── Search
  └── Messaging
          │
          ▼
MySQL database
```

Google Maps services are used separately to convert addresses into geographical coordinates and display listings geographically.

## Secondary project: E-commerce prototype

`ecomm/` is an earlier web-development project focused on:

- account registration and login;
- product presentation;
- shopping-cart interactions;
- checkout workflow;
- PHP and MySQL integration;
- frontend state management with JavaScript.

This project is retained to show the progression from an initial e-commerce implementation to the more complete architecture used in StudWeb.

## Repository structure

```text
webProgramming/
├── ecomm/                  # Earlier e-commerce prototype
├── studweb/                # Main location-based marketplace project
│   ├── css/                # Stylesheets
│   ├── inc/                # Database and server-side handlers
│   ├── impostazioni/       # Account settings
│   ├── js/                 # Frontend behaviour and AJAX logic
│   ├── chat.php            # Messaging interface
│   ├── esplora.php         # Listing exploration and map view
│   ├── indstud.php         # Main application entry point
│   └── pubblica.php        # Listing publication workflow
├── docs/
│   ├── ARCHITECTURE.md
│   └── MANUAL_TESTS.md
└── README.md
```

## Running the projects locally

The applications were originally developed in a local Apache/PHP/MySQL environment, such as MAMP, XAMPP, or a similar stack.

### Requirements

- Apache or another PHP-compatible web server
- PHP
- MySQL
- A web browser
- A Google Maps API key for map and geocoding functionality

### General setup

1. Clone the repository:

   ```bash
   git clone https://github.com/ciprianisamuele/webProgramming.git
   ```

2. Place the repository inside the document root of your local web server.

3. Create the required MySQL databases and tables for the project being tested.

4. Configure the database connection in the corresponding PHP connection file using local credentials.

5. Replace the Google Maps placeholder with your own restricted API key where map functionality is required.

6. Start Apache and MySQL.

7. Open the desired entry point in the browser:

   ```text
   /studweb/indstud.php
   ```

   or:

   ```text
   /ecomm/e-comm.php
   ```

### Important setup limitation

The original projects were developed against local MySQL databases. A complete portable database dump is not currently included in the repository, so reproducing every workflow requires reconstructing the database schema from the application code or adding an exported schema.

This limitation is documented explicitly rather than presenting the repository as a ready-to-deploy application.

## Testing

The applications were tested manually during development. The main workflows included:

- account registration;
- valid and invalid login attempts;
- session persistence and logout;
- listing creation;
- multiple-image upload;
- address geocoding;
- map rendering;
- search and pagination;
- sending and retrieving messages;
- validation of incomplete form submissions.

A structured checklist is available in [`docs/MANUAL_TESTS.md`](docs/MANUAL_TESTS.md).

## Security and privacy

- Previously committed local credentials and API keys have been removed from the active repository history.
- The repository contains placeholders rather than usable credentials.
- Users must provide their own local database configuration and Google Maps API key.
- The applications are educational prototypes and have not undergone a production security review.
- Further validation, authorization checks, CSRF protection, upload hardening, and automated security testing would be required before deployment.

## Current status

The repository is preserved as a portfolio and learning archive.

The code demonstrates the complete connection between frontend pages, PHP server-side logic, relational data storage, authentication, third-party API integration, image handling, and user-to-user messaging. It is not currently maintained as an online service.

## What I learned

These projects provided practical experience with:

- designing multi-page web applications;
- connecting frontend and backend components;
- modelling relational data;
- implementing registration, authentication, and sessions;
- using prepared SQL statements and password hashing;
- handling files and images;
- integrating external APIs;
- building asynchronous interactions with AJAX;
- debugging an application across multiple layers;
- using Git and GitHub for version control;
- documenting project architecture, limitations, and testing.

## Author

**Samuele Cipriani**
