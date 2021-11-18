<?php

class ConnectionFactory{
    static $pdo;
    static function makeConnection($conf){
        try {
            $host = $conf['host'];
            $dbname= $conf['db'];
            $user = $conf['user'];
            $password = $conf['password'];
            ConnectionFactory::$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    static function getConnection(){
        return ConnectionFactory::$pdo;
    }

}
