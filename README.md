## About Vanilla Widgets API

Soapbox is single page application blog built using Laravel, Vue and Vuetify.

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
- `docker-compose exec vanilla_php_fpm php artisan config:clear`