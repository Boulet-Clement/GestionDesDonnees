<?php 
namespace App\Model;
use App\Model\Model;
use config\ConnectionFactory;
//require __DIR__ . '/Model.php';
class Article extends Model{
    private $id, $nom, $description, $tarif, $stock;

    protected static $table='article';
    protected static $idColumn='id';

    public function __construct( array $t=null) {
    /* initialiser les attributs */
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
        $sql = 'insert into article(`nom`,`descr`,`tarif`,`id_categ`) values (\'test\',\'ouiiii\',201,1)';
        // bind param 
        $stmt=ConnectionFactory::getConnection()->prepare($sql);
        return $stmt->execute();
    }
}