<?php

require_once "../src/vendor/autoload.php" ;

$client = new MongoDB\Client("mongodb://mongo");
$collection = $client->td3->parkings;

//On récupère les données postées
$comment = $_POST['input_comment'];
$parkingID = $_POST['input_id'];

//On cherche notre parking correspondant
$cursor = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($parkingID)]);

// Si il n'a pas encore de commentaire on créé le tableau
if (!isset($cursor['comments'])){
    $cursor['comments'] = [];
    array_push($cursor['comments'],$comment);
    $collection->updateOne(
        [ '_id' => $cursor['_id'] ],
        [ '$set' => [ 'comments' => $cursor['comments']]]
    );
//Sinon on lui ajoute simplement le commentaire
}else{
    $collection->updateOne(
        [ '_id' => $cursor['_id'] ],
        [ '$push' => [ 'comments' => $_POST['input_comment']]]
    );
}
// On redirige vers la page de base
header('Location: http://localhost:12080');





   
