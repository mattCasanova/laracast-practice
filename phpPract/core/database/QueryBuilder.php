<?php 

class QueryBuilder {
    protected $pdo;

    public function __construct(PDO $pdo) 
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table, $class) {
        $statement = $this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();

        if ($class === null) {
            return $statement->fetchAll(PDO::FETCH_CLASS);
        }

        return $statement->fetchAll(PDO::FETCH_CLASS, "App\\Models\\{$class}");
    }

    public function insert($table, $params)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}


?>