# Motask

Demo : [motask.herokuapp.com](http://motask.herokuapp.com)

## Installation

- Run this command
```sh
$ git clone https://github.com/gerrykastogi/Motask_HMIF.git
$ composer install
```

- Copy `.env.example` file to `.env`. Adjust environment variables for database(pgsql/mysql, db_host, port, username, password) and `APP_URL` (http://motask.app `or` http://localhost:8000) depend on your development environment.

- Create empty database : `motask`

- Run this command to sync database schema
```sh
$ php artisan migrate
```
- Test it on browser