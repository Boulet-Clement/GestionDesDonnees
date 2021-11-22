<?php 
namespace App\Model;
use App\Model\Model;
//require __DIR__ . '/Model.php';
class Article extends Model{
    private $id, $nom, $description, $tarif, $stock;

    protected static $table='article';
    protected static $idColumn='id';

    public function __construct( array $t=null) {
    /* initialiser les attributs */
    }

    public static function findById(Int $id) : Article {
        $pdo= ConnectionFactory::getConnection();
        $sql = 'select * from article where id= ?';
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(1, $id, \PDO::PARAM_INT);
        if ($stmt->execute()) {
        $article_data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new \models\Article( $article_data );
        } else return null ;
    }
}