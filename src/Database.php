<?php

/*
 * This file is part of the API Platform Heroku package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dunglas\Heroku;

/**
 * Creates Doctrine database parameters from the environment variable set by Heroku Postgres.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Database
{
    /**
     * Creates parameters.
     */
    public static function createParameters()
    {
        $database = parse_url(getenv('DATABASE_URL'));
        var_dump(getenv('DATABASE_URL'));

        putenv(sprintf('SYMFONY__DATABASE_HOST=%s', $database['host']));
        putenv(sprintf('SYMFONY__DATABASE_PORT=%s', $database['port']));
        putenv(sprintf('SYMFONY__DATABASE_USER=%s', $database['user']));
        putenv(sprintf('SYMFONY__DATABASE_PASSWORD=%s', $database['pass']));
        putenv(sprintf('SYMFONY__DATABASE_NAME=%s', ltrim($database['path'], '/')));
    }
}
