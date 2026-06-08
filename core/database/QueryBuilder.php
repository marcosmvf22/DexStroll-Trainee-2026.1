<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function selectAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

//catei do outro codigo
    public function selectOne($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = :id LIMIT 1";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

//util pra paginar, estattiscticas etc
    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) AS total FROM {$table}";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

//assim achoq ue nao preciso ficar alterando todas as funcoes do controller
    public function insert($table, $parameters)
    {
        $columns = implode(', ', array_keys($parameters));
        $placeholders = ':' . implode(', :', array_keys($parameters));

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            $columns,
            $placeholders
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function update($table, $id, $parameters)
    {

    $setClause = implode(', ', array_map(function($param) {
            return "{$param} = :{$param}";
        }, array_keys($parameters)));

//verificação do id, dá menos erro
        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = :id',
            $table,
            $setClause
        );


        $parameters['id'] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    //tentando  unificar  os 2 querybuilder 
    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function paginate($table, $limit, $offset)
    {
        $sql = "SELECT * FROM {$table} LIMIT :limit OFFSET :offset";
        try {
            $stmt = $this->pdo->prepare($sql);
    //acho que o mysql só aceita  assim

            $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function selectWhere($table, $conditions)
    {
        $whereParts = [];
        foreach ($conditions as $col => $val) {
            $whereParts[] = "{$col} = :{$col}";
        }
        $whereClause = implode(' AND ', $whereParts);
        $sql = "SELECT * FROM {$table} WHERE {$whereClause}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
