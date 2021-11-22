<?php 

require __DIR__ . '/connexion.php';

$conf = parse_ini_file('db.conf.ini');

ConnectionFactory::makeConnection($conf);

$myPdo = ConnectionFactory::getConnection();

use App\Model\Article;

//require __DIR__ . '/../src/Model/Article.php';

$a = new Article(); $a->nom = 'velo'; $a->tarif=273;
$a->insert();
$liste = Article::all();
foreach( $liste as $article) {
 print $article->nom;
}