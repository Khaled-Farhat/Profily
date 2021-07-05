<?php

use App\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => Config::HOST,
	'username' => Config::DB_USERNAME,
	'password' => Config::DB_PASSWORD,
	'database' => 'profily',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => ''
]);

$capsule->bootEloquent();

?>