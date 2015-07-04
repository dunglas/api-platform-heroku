<?php

/*
 * This file is part of the API Platform Heroku package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dunglas\Heroku\Tests;

use Dunglas\Heroku\Database;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateParameter()
    {
        // Be sure variables are empty
        putenv('SYMFONY__DATABASE_HOST=');
        putenv('SYMFONY__DATABASE_PORT=');
        putenv('SYMFONY__DATABASE_USER=');
        putenv('SYMFONY__DATABASE_PASSWORD=');
        putenv('SYMFONY__DATABASE_NAME=');

        putenv('DATABASE_URL=pgsql://user:pass@api-platform.com:1234/dbname');
        Database::createParameters();

        $this->assertEquals('api-platform.com', getenv('SYMFONY__DATABASE_HOST'));
        $this->assertEquals('1234', getenv('SYMFONY__DATABASE_PORT'));
        $this->assertEquals('user', getenv('SYMFONY__DATABASE_USER'));
        $this->assertEquals('pass', getenv('SYMFONY__DATABASE_PASSWORD'));
        $this->assertEquals('dbname', getenv('SYMFONY__DATABASE_NAME'));
    }
}
