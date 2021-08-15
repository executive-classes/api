<?php

namespace Tests;

use Illuminate\Database\Connection;
use Mockery;

trait MocksDatabase
{
    /**
     * @var \Mockery\Mock|\Illuminate\Database\Connection
     */
    protected $db;

    /**
     * Creates the database mock.
     *
     * @return void
     */
    public function mockDb()
    {
        // Creates the database mock.
        $this->db = Mockery::mock(
            Connection::class . '[select,update,insert,delete]',
            [Mockery::mock(PDO::class)]
        );

        // Define the database as the mock.
        $manager = $this->app['db'];
        $manager->setDefaultConnection('mock');

        $reflection = new \ReflectionClass($manager);
        $properties = $reflection->getProperty('connections');
        $properties->setAccessible(true);
        $list = $properties->getValue($manager);
        $list['mock'] = $this->db;
        $properties->setValue($manager, $list);
    }
}