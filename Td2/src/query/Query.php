<?php 
namespace App\query;
use config\ConnectionFactory;

class Query {
    private $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    private $sql = '';

    public static function table(string $table) : Query {
        $query = new Query;
        $query->sqltable= $table;
        return $query;
    }

    public function select(array $fields) : Query{
        $this->fields = implode(',', $fields);
        return $this;
    }

    public function where(string $col,
                            string $op,
                            string $val): Query {
        if ($this->where == null){
            $this->where = $col . ' ' . $op . ' "' . $val .'"';
        }else{
            $this->where = $this->where . ' and ' . $col . ' ' . $op . ' "' . $val .'"';
        }
        
        return $this;
    }

    public function get() : Array {
        $this->sql = 'select ' . $this->fields . 
                    ' from ' . $this->sqltable .
                    ' where ' . $this->where;
        echo($this->sql);
            /* ... to do ... */
        $stmt = ConnectionFactory::getConnection()->prepare($this->sql); // A verifier ci ceci fonctionne correctement
        $stmt->execute($this->args);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}