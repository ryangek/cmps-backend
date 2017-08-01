
## Heroku-Laravel-Example

This project is designed to be easily deployed on heroku. It contains the following configuration:

- Procfile with a web process.
- Database configuration Defaults to use Postgres using heroku-postgres `DATABASE_URL` environment variable.
- Configured to [trust the Heroku Load balancers](https://devcenter.heroku.com/articles/getting-started-with-laravel#trusting-the-load-balancer). 
- Getting [batch](https://drive.google.com/file/d/0B-ncD-RnMTRid3haQ0NxdHQwcWc/view) file.

## Local Development

**1. Database, app key, .env**

Clone this repository and run the following commands:

```sh
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

**2. Run**

```sh
php artisan serve
```

## Deploying to Heroku

**1. Create a Heroku App with postgres addon**

Set your own app name on line 1 below

```sh
app_name=one-eighty-test
heroku apps:create $app_name
heroku addons:create heroku-postgresql:hobby-dev --app $app_name
```

**2. Add Heroku remote**

```sh
heroku git:remote --app $app_name
```

**3. Set Config Parameters**

To operate correctly you need to set `APP_KEY`, `APP_LOG` the following prams:

```sh
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
heroku config:set APP_LOG=errorlog
```

Additionally, to keep the app in development mode and throwing errors set the following:

```sh
heroku config:set APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug
```

**4. Deploy to Heroku**

```sh
 git push heroku master
```

## Additional Notes

**Trust the load balancer**

This project is setup to trust the heroku load balancers. This will help with routing and url generation. For more information see [here](https://devcenter.heroku.com/articles/getting-started-with-laravel#trusting-the-load-balancer).

**Running a worker process**

This [Stack Overflow Answer](http://stackoverflow.com/a/38443082/184130) shows a simple addition to the Procfile can run your worker
in another process.

Using `--daemon` is not necessary in Laravel 5.4 and setting up your queues on redis (or using the DB) is not covered here.

```
queue: php artisan queue:work redis --sleep=3 --tries=3
```

---


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
