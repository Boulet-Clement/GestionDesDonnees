<?php
namespace src\model;
use \Illuminate\Database\Eloquent\Model;

class Item extends Model{
    protected $table = 'item'; 
    protected $primaryKey = 'id';
}
