# API Platform and Symfony helpers to deploy on Heroku

This library eases the deployment of [API Platform](http://api-platform.com) and [Symfony](http://symfony.com)
applications on the [Heroku](http://heroku.com) platform.

[![Build Status](https://travis-ci.org/dunglas/api-platform-heroku.svg?branch=master)](https://travis-ci.org/dunglas/api-platform-heroku)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dunglas/api-platform-heroku/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dunglas/api-platform-heroku/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9f4c8c22-9bf8-4467-ab2b-2d0c73210827/mini.png)](https://insight.sensiolabs.com/projects/9f4c8c22-9bf8-4467-ab2b-2d0c73210827)
[![Dependency Status](https://www.versioneye.com/user/projects/559809aa6166340022000013/badge.svg?style=flat)](https://www.versioneye.com/user/projects/559809aa6166340022000013)

## Install

Use [Composer](http://getcomposer.org) to install the library in your project:

`composer require dunglas/api-platform-heroku`

## Database helper

The library provides a Composer script to create Symfony parameters for the Doctrine bundle by parsing the `DATABASE_URL`
environment variable populated by the Heroku Postgres addon.

To use it, start by adding the script to your `composer.json` file:

```json
// ...
    "scripts": {
        "pre-install-cmd": [
          "Dunglas\\Heroku\\Database::createParameters"
        ],
        // ...
    }
```

Thanks to the ability of the Symfony Dependency Injection Component to read parameters from special environment variables,
the parameters are automatically populated.
 
Change the content of the `app/config/services.yml` like the following to use them:

```yaml
doctrine:
    dbal:
        driver:   "pdo_pgsql"
        host:     "%database_host%"
        port:     "%database_port%"
        dbname:   "%database_name%"
        user:     "%database_user%"
        password: "%database_password%"
        charset:  UTF8
```

In your local development environment, don't forget to set the `SYMFONY__DATABASE_URL` environment variable.
A typical value for that variable is `postgres://user:pass@server:5432/dbname.

A convenient way to manage environment variable is the [PHP dotenv](https://github.com/vlucas/phpdotenv) library.

## Credits

This library is part of the [API Platform](http://api-platform.com) project. Created by [Kévin Dunglas](dunglas@gmail.com).
