<?php 
namespace App\Model;
use App\Model\Model;
use config\ConnectionFactory;
use \PDO;

class Article extends Model{

    protected static $table='article';
    protected static $idColumn='id';

    public function __construct( array $t=null) {
    /* initialiser les attributs */
        if(!is_null($t)) $this->_v = $t;
    }

    public static function findById(Int $id) : Article {
        $sql = 'select * from article where id= ?';
        $stmt=ConnectionFactory::getConnection()->prepare($sql);
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);
        if ($stmt->execute()) {
        $article_data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Article( $article_data);
        } else return null ;
    }

    public function insert() :int {
        $sql = 'insert into article(`nom`,`descr`,`tarif`,`id_categ`) values (?,?,?,?)';
        $stmt=ConnectionFactory::getConnection()->prepare($sql);
        $retour = $stmt->execute(array($this->__get("nom"),
                                $this->__get("descr"),
                                $this->__get("tarif"),
                                $this->__get("categorie")));
        $this->__set("id",ConnectionFactory::getConnection()->lastInsertID());
        return $retour;
    }

}