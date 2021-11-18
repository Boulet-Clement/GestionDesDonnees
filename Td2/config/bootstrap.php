<?php 

require __DIR__ . '/connexion.php';

$conf = parse_ini_file('db.conf.ini');

ConnectionFactory::makeConnection($conf);

$myPdo = ConnectionFactory::getConnection();
