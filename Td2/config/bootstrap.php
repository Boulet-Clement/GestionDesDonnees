<?php 

use config\ConnectionFactory;
use App\Model\Article;
//require __DIR__ . '/connexion.php';

$conf = parse_ini_file('db.conf.ini');

ConnectionFactory::makeConnection($conf);

$myPdo = ConnectionFactory::getConnection();

//use App\Model\Article;

//require __DIR__ . '/../src/Model/Article.php';
/*
$a = new Article(); 
$a->nom ='oui'; 
$a->tarif=243;
$a->descr="un test";
$a->categorie=1;
$a->insert(); //? pourquoi faut-il la mettre publique?
echo 'article inséré id: '. $a->id ."\n";
var_dump(Article::findById($a->id));
*/

$liste = Article::all();
foreach( $liste as $article) {
    echo $article->nom . "\n";
}