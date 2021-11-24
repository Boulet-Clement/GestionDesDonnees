<?php 
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
                            mixed $val): Query {
        /* ... to do ... */
        $this->args[]=$val;
        return $this;
    }

    public function get() : Array {
        $this->sql = 'select ' . $this->fields . 
                    ' from ' . $this->sqltable;
            /* ... to do ... */
        $stmt = ConnectionFactory::getConnection()->prepare($this->sql); // A verifier ci ceci fonctionne correctement
        $stmt->execute($this->args);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}