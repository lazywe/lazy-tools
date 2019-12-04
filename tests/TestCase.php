<?php

/**
 * This file is part of the lazywe.
 *
 * (c) dev@huiwenliye.com
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lazy\Tools\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $app;

    public function setUp()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';
        $app->useEnvironmentPath(realpath(__DIR__ . '/'));
        $app->loadEnvironmentFrom('.env.testing');
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        $app->register('Lazy\Tools\ServiceProvider');
        $this->app = $app;
        $config = require __DIR__ . '/../config/lazy-tools.config.php';
        $this->app['config']->set('lazy-tools', $config);
    }

    public function testApplicaion()
    {
        $this->assertTrue(true);
    }
}
