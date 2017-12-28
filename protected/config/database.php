<?php

// This is the database connection configuration.
return array(
    'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
    // uncomment the following lines to use a MySQL database
    'connectionString' => 'mysql:host=localhost:3307;dbname=p1',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
);
