<?php

require_once "../src/vendor/autoload.php" ;

$client = new MongoDB\Client("mongodb://mongo");

$collection = $client->td3->beers;

$result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
/*
echo "Inserted with Object ID '{$result->getInsertedId()}'";

*/
//curl php curl