# Debugging Database Queries

Quickly debugging the amount of database queries per request in Laravel.

![sql-doctor example image](sql-doctor.png?raw=true "Sql Doctor")

## Install

### Install via composer

#### For Laravel <= 5.3, please use the [1.1 branch](https://github.com/squareboat/sql-doctor/tree/v1.1)!

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

| Query Param | Value | Output                                         |
| ----------- |:-----:| :--------------------------------------------- |
| sql-doctor  | 1     | Default query                                  |
| sql-doctor  | 2     | Binds values to their parameters in the query. |

## Credits

SQL Doctor, originally developed after the [reddit thread](https://www.reddit.com/r/laravel/comments/5f7y9f/debugging_the_amount_of_database_queries_per) by [magkopian](https://www.reddit.com/user/magkopian).

# License

The MIT License. Please see [License File](LICENSE.md) for more information. Copyright © 2017 [SquareBoat](https://squareboat.com)
