# Laravel Blog App

This is a simple Blog built with Laravel 12 that lets users see the blog page with pagination and read single blog posts. Logged in users will be able to comment on the blog posts.

The app uses the default Laravel 12 + React 19/TypeScript/Tailwind (with Inertia) starting pack for user authentication. This pack also includes GitHub CI workflows for tests and linter. 

More info about the starter pack - https://laravel.com/docs/12.x/starter-kits#react

## Requirements

Docker to start the containers.

If you are not using Docker you will need a Web `server` like Apache, nginx or XAMPP with `PHP 8.2` and `MySQL`. Also install `composer` and `artisan` (if you install Laravel globally from the Laravel Installer this will include artisan for your system).

## Docker

This app is using this famous package for Docker setup. To understand more read their docs:

https://docs.docker.com/guides/frameworks/laravel/development-setup/

https://github.com/dockersamples/laravel-docker-examples

The original package is slightly changed for the purposes of this App.

Basically there are 2 docker compose files in the root dir for dev and prod that are using the /docker folder to start the docker containers. 

To start the Docker containers run

`docker compose -f compose.dev.yaml up -d`

After the containers start you should be able to see the app on the browse at http://localhost:80

To enter into the workspace container bash terminal in order to execute php artisan commands:

`docker compose -f compose.dev.yaml exec workspace bash`

## Configuration

Run in console:

`composer install` to install the PHP dependencies in vendor folder

`npm install` to install the JS dependencies in node_modules folder

Create a .env file from the .env.example

App configuration is done in config/blog.php

Execute these commands (from inside the workspace container if using Docker):

`php artisan migrate` to create the database

`php artisan db:seed` to seed the DB with users, posts and comments for manual testing

## Running the app

Before being able to see the app on the browser you need to build the frontend resources:

`npm run build` to build once

`npm run dev` if you are developing

Then make sure you see the Laravel 12 homepage on the browser by visiting `http://localhost`.

The blog is accessible on the /blog page.

## Tests

Additional test files are included in the tests/Feature directory. 

To run the tests execute `php artisan test` in the console (not in the container).

## Database structure

You can see the DB structure from database/migrations files.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

