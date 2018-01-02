<?php

// This is the database connection configuration.
return array(

	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

<<<<<<< HEAD
	'connectionString' => 'mysql:host=localhost:3307;dbname=p1',
	'username' => 'root',
	'password' => '',
=======
	'connectionString' => 'mysql:host=localhost;dbname=p1',
	'username' => 'root',
	'password' => 'BattelShip',
>>>>>>> bed55627db8cd1ced6782da1ea9236ded85d30f5
	'charset' => 'utf8',

);

