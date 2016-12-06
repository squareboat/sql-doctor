# Debugging Database Queries

Quickly debugging the amount of database queries per request in Laravel.

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

# License

The MIT License. Please see [License File](LICENSE.md) for more information. Copyright © 2016 [SquareBoat](https://squareboat.com)
