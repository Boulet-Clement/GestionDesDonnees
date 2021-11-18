<?php
namespace src\Model;
use \Illuminate\Database\Eloquent\Model;

class Carte extends Model{
    protected $table = 'carte'; 
    protected $primaryKey = 'id';

    public static function findAll(){
        return Carte::all();
    }
    public static function findAllAlphabetic(){
        
    }
}
