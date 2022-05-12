<?php

include __DIR__.'/vendor/autoload.php';

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection([ 'driver' => 'mysql',
                          'host' =>'localhost',
                          'database' => 'lesson',
                          'username' =>'dim',
                          'password' =>'pass',
                          'charset' => 'utf8',
                          'collation' => 'utf8_unicode_ci',
                          'prefix' => '',
                        ]);
$capsule->bootEloquent();
$capsule->setAsGlobal();

