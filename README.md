# Debugging Database Queries

Quickly debugging the amount of database queries per request in Laravel.

![sql-doctor example image](sql-doctor.png?raw=true "Sql Doctor")

## Install

### Install via composer

```
$ composer require squareboat/sql-doctor
```

### Configure Laravel

Once installation operation is complete, simply add the service provider to your project's `config/app.php` file:

#### Service Provider
```
SquareBoat\SqlDoctor\SqlDoctorServiceProvider::class,
```

## Usage

Now while your `app.debug` is set `true` then on any URL you can append `?sql-doctor=1` and get an output of complete list of queries that ran.

## Credits

SQL Doctor, originally developed after the [reddit thread](https://www.reddit.com/r/laravel/comments/5f7y9f/debugging_the_amount_of_database_queries_per) by [magkopian](https://www.reddit.com/user/magkopian).

# License

The MIT License. Please see [License File](LICENSE.md) for more information. Copyright © 2016 [SquareBoat](https://squareboat.com)
