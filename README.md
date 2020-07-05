## About Vanilla Widgets API

This application is a REST api to allow authenticated users the ability to create, update, retrive and delete widgets. It was made using Laravel.

## Setup

### Requirments
- Docker

Follow the steps below to run the site locally.

#### Copy the example .env file and edit the file to add the correct values
* NOTE: There is an .env file in the root folder and as well as the backend folder, both need to be present and both need the same database values. I know you can set the env file on the services in the docker compose file but I couldn't get it to work.

- `cp .env.example .env`
- `code .env`
- Create a database name, user and password in the env file, these values will be used to create the mysql container. Make sure the `DB_HOST` environment variable is set to the mysql container name `vanilla_mysql`.

#### Set the environment variables and create the docker containers
- Change the `xdebug.remote_host` in the `./php/xdebug.ini` depending on your environment
- - Using windows or mac with docker desktop use `"host.docker.internal"` as the value
- - Using linux use the systems ip address. Use the command `ifconfig` if you are not sure what your ip is, use the inet value.
- `docker-compose up -d --build`
- `docker-compose exec vanilla_php_fpm composer install`

#### Setup the appliction
- `docker-compose exec vanilla_php_fpm php artisan key:generate`
- `docker-compose exec vanilla_php_fpm php artisan jwt:secret`
- `docker-compose exec vanilla_php_fpm php artisan migrate`
- `docker-compose exec vanilla_php_fpm php artisan config:cache`

#### Use the application
* NOTE: All requests to the api must be JSON. You will need the header 'Accept: application/json' for all requests. To post or patch information you will need the header 'Content-Type: application/json'

- Register a user by sending a POST request to '/api/register' with the following json structure
- - 'name' => 'string, maximum 255'
- - 'email' => 'string, valid email address'
- - 'password' => 'string, minimum 8 characters'
- - 'password_confirmation' => 'string, matching password'
- Login to recieve the JWT by sending a POST request to '/api/login' with the following json structure
- - 'email' => 'string, valid email address'
- - 'password' => 'string, minimum 8 characters'
- - use the token as a bearer token for all widget requests
- Create a widget by sending a POST request to '/api/widget' with the following json structure
- - 'name' => 'string, maximum 20 characters'
- - 'description' => '(optional) string,  maximum 100 characters'
- Update a widget by sending a PATCH request to '/api/widget/{widget_id}' with the following json structure
- - 'name' => 'string, maximum 20 characters'
- - 'description' => '(optional) string,  maximum 100 characters'
- Retrieve an individual widget by sending a GET request to '/api/widget/{widget_id}', no body is required
- Retrieve all widgets by sending a GET request to '/api/widget', no body is required
- Delete a widget by sending a DELETE request to '/api/widget/{widget_id}', no body is required