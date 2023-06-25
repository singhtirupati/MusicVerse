# MUSIC VERSE

Music Verse, a full stack music player application demonstrating CRUD operation. Implemented using MVC architecture.

## Features

- Login and Registration
- User can update profile
- Play music
- Upload music
- Add Music to Favourite

**Tech Stack Used:** *HTML, CSS, JAVASCRIPT, AJAX, PHP, MVC, COMPOSER*

------

## Screenshots
<!-- ![alt tag]() -->
![alt text](public/img/screenshots/homepage.png "Homepage Page")
![alt text](public/img/screenshots/play-music.png "Nowplaying Page")

# Structure
```
.
├── application (All classes related to the application)
│    ├── controller
│    ├── model
│    └── view
├── public (Contains assets (images, JavaScript, CSS, music files, etc)
├── system (All core classes)
├── composer.json
├── composer.lock
└── index.php
``` 

# How to Run Locally

In order to run the application, it is necessary to create a virtual host and setup database.

## Prerequisites

To start this project, you need to have the following components installed:

* [PHP](http://php.net) - PHP is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.
* [MySQL](https://www.mysql.com) - MySQL is an open source relational database management system (RDBMS) based on Structured Query Language (SQL).
* [Composer](https://getcomposer.org) - Composer is an open source dependency management tool for PHP, created primarily to facilitate the distribution and maintenance of PHP packages as individual application components.
* [Apache](https://httpd.apache.org) or [Nginx](https://www.nginx.com) - An HTTP server.


## Steps to setup project

1. Download the archive or clone the project using git.
2. Create database schema.
3. Create `.env` file from `.env.example` file and adjust database parameters (including schema name)
4. Run `composer install` to install any PHP dependencies.
5. Start the PHP server by running command `php -S 127.0.0.1:8080` 
6. Open in browser http://127.0.0.1:8080

------
