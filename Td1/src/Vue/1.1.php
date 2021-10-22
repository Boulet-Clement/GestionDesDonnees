<?php

use \Illuminate\Database\Eloquent\Model;
use src\Model\Carte;

require __DIR__ . '/../../index.php';
require __DIR__ . '/../Model/carte.php';
/*
$list =Carte::Where('nom_proprietaire','like','%e%')->get();

if ($list != null){
    foreach($list as $item){
        print $item->id;
    }
}*/
$cartes = src\Model\Carte::findAll();
foreach ($cartes as $carte) {
    print_r($carte->id. " " . $carte->nom_proprietaire . " " . $carte-> mail_proprietaire
    . " " . $carte->cumul . "\n");
}
//print_r($cartes);