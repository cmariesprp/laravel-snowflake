# Laravel Snowflake

A Laravel wrapper of [PHP Snowflake](https://github.com/bradietilley/php-snowflake) to provide a simple, opinionated implementation of Snowflake IDs for your eloquent models.

![Static Analysis](https://github.com/bradietilley/laravel-snowflake/actions/workflows/static.yml/badge.svg)
![Tests](https://github.com/bradietilley/laravel-snowflake/actions/workflows/tests.yml/badge.svg)
![Laravel Version](https://img.shields.io/badge/Laravel%20Version-11.x-F9322C)
![PHP Version](https://img.shields.io/badge/PHP%20Version-8.3-4F5B93)

## Introduction

The laravel-snowflake package provides a seamless way to generate unique, time-ordered, distributed IDs within your Laravel application. Unlike traditional auto-incrementing IDs, Snowflake IDs offer several advantages: they eliminate ID collisions across distributed systems, enhance horizontal scalability, and prevent predictable sequential exposure of database records. Compared to UUIDs and ULIDs, Snowflake IDs are shorter, visually appealing, and easier to write out, making them ideal for public identifiers. This package integrates smoothly with Laravel, offering microsecond precision while ensuring high-performance, conflict-free ID generation across multiple clusters and workers. 🚀

## Installation

```
composer require bradietilley/laravel-snowflake
```

## Documentation

**Preparing your schema:**

You'll want to make sure that your model's primary key does not autoincrement. Autoincrement is automatically added when you use `$table->id();` so go ahead and switch this out:

```diff
-$table->id();
+$table->bigInteger('id')->unsigned()->primary();
```

**Integrating with you models:**

Next you'll want to add the `HasSnowflake` trait to your models. This trait this will handle all aspects of a snowflake ID including:

- Automatically setting the `id` to a Snowflake ID
- Configuring the cast for `id` to `string`
- Disabling `increments` on the model
- Configuring the `keyType` to `string`

This can be done as simple as:

```php
use BradieTilley\Snowflakes\Eloquent\HasSnowflake;

class SomeModel extends Model
{
    use HasSnowflake;
}
```

You're all set.

```php
$model = SomeModel::create();
$model->id; // 9348975348573485734
```

## Author

- [Bradie Tilley](https://github.com/bradietilley)
