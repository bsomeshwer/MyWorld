<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Someshwer\WorldCountries\Facades\World;

//use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{

    protected function getPackageProviders($app)
    {
        return ['Someshwer\WorldCountries\WorldDataServiceProvider'];
    }

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
    }

    /** @test */
    public function testStaticRoute()
    {
        // Arrange
        $info = World::info();

        // Assert
        $this->assertEquals($info['package_name'], 'Laravel - My World');
    }

}
