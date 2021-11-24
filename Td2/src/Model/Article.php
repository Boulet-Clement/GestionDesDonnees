<?php 
namespace App\Model;
use App\Model\Model;
//require __DIR__ . '/Model.php';
class Article extends Model{
    private $id, $nom, $description, $tarif, $stock, $pdo;

    protected static $table='article';
    protected static $idColumn='id';

    public function __construct( array $t=null,$pdo) {
        $this->pdo = $pdo;
    /* initialiser les attributs */
    }

    public static function findById(Int $id) : Article {
        $sql = 'select * from article where id= ?';
        $stmt=self::$pdo->prepare($sql);
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);
        if ($stmt->execute()) {
        $article_data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Article( $article_data , self::$pdo);
        } else return null ;
    }

    private function insert() :int {
        $sql = 'insert into article(`nom`,`descr`,`tarif`,`stock`) values (?,?,?,?)';
        // bind param 
        $stmt=self::$pdo->prepare($sql);
        return $stmt->execute();
    }
}