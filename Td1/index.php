<?php

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Eloquent\Model;



$capsule = new Capsule;



$capsule->addConnection([

   "driver" => "pdo_mysql",

   "host" =>"127.0.0.1",

   "port" => '3306',

   "database" => "td1",

   "username" => "root",

   "password" => "",

   'charset'   => 'utf8',

   'collation' => 'utf8_unicode_ci'

]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
$capsule->bootEloquent();

class Item extends Model{
    protected $table = 'item'; 
    protected $primaryKey = 'id';
}

$list =Item::Where('lebelle','like','%eau%')->get();
if ($list != null){
    foreach($list as $item){
    print $item->id;
}
}
