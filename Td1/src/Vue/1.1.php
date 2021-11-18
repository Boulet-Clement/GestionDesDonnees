<?php

use \Illuminate\Database\Eloquent\Model;
use src\Model\Carte;

require __DIR__ . '/../../index.php';
require __DIR__ . '/../Model/carte.php';

$cartes = src\Model\Carte::findAll();
foreach ($cartes as $carte) {
    print_r($carte->nom_proprietaire 
    . " " . $carte-> mail_proprietaire
    . " " . $carte->cumul . "\n");
}