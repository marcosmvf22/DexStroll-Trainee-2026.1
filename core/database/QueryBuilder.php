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

    public function selectAllUser($table)
    {
        $sql = "select * from {$table}";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectAll($table)
    {
        $sql = "select * from {$table}";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) AS total FROM {$table}";
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function paginate($table, $limit, $offset)
    {
        $sql = "SELECT p.* ,u.username as autor FROM  publicacao p LEFT JOIN usuarios u ON p.autor = u.id LIMIT {$limit} OFFSET {$offset}"; 
        if ($table !== 'publicacao'){
            $sql = "SELECT * FROM {$table} LIMIT {$limit} OFFSET {$offset}";
        }
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectWhereUser($table, $where)
    {
        $columns = array_keys($where);
        $conditions = implode(' AND ', array_map(fn($col) => "$col = :$col", $columns));
        $sql = "SELECT * FROM {$table} WHERE {$conditions}";
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($where as $col => $val) {
                $stmt->bindValue(":$col", $val);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
     public function selectOne($table, $id)
    {
         $sql = sprintf('SELECT * FROM %s WHERE id=:id LIMIT 1',$table);
         try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function update($table, $id, $parameters){
        $sql = sprintf('UPDATE %s SET %s WHERE id = %s',
        $table,
        implode(', ', array_map(function($param){
            return $param . ' = :' .$param;
        }, array_keys($parameters))),
        $id
        );
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function insertUser($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }
            return $stmt->execute();
            } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    

    public function verificaLogin($email){
        $sql = sprintf('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;
        } catch (Exception $e){
            die($e ->getMessage());
        }
    }

    public function insert($table, $parameters){
        $sql = sprintf('INSERT INTO %s (%s) VALUES (:%s)',
        $table,
        implode(', ', array_keys($parameters)),
        implode(', :', array_keys($parameters)),
        );
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function updateUser($table, $data, $where)
    {
        $setParts = [];
        foreach ($data as $col => $val) {
            $setParts[] = "$col = :$col";
        }
        $setClause = implode(', ', $setParts);
        $whereParts = [];
        foreach ($where as $col => $val) {
            $whereParts[] = "$col = :where_$col";
        }
        $whereClause = implode(' AND ', $whereParts);
        
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$whereClause}";
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $col => $val) {
                $stmt->bindValue(":$col", $val);
            }
            foreach ($where as $col => $val) {
                $stmt->bindValue(":where_$col", $val);
            }
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteUser($table, $where)
    {
        $whereParts = [];
        foreach ($where as $col => $val) {
            $whereParts[] = "$col = :$col";
        }
        $whereClause = implode(' AND ', $whereParts);
        $sql = "DELETE FROM {$table} WHERE {$whereClause}";
        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($where as $col => $val) {
                $stmt->bindValue(":$col", $val);
            }
            return $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($table, $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s',
        $table,
        'id = :id'    
        );
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));
        } catch (Exception $e){
            die($e->getMessage());
        }
    }


    
    public function countSearch($table, $termo)
    {
        $sql = "SELECT COUNT(*) AS total FROM {$table} 
                WHERE username LIKE :termo 
                OR nome LIKE :termo 
                OR email LIKE :termo";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':termo', '%' . $termo . '%');
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function paginateSearch($table, $termo, $limit, $offset)
    {
        
        $sql = "SELECT * FROM {$table} 
                WHERE username LIKE :termo 
                OR nome LIKE :termo 
                OR email LIKE :termo 
                LIMIT :limit OFFSET :offset";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':termo', '%' . $termo . '%', PDO::PARAM_STR);
            $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
   
    

//buscadeposts?:::::



    public function countSearchposts($table, $termo)
    {
        $sql = "SELECT COUNT(*) AS total FROM {$table} 
                WHERE titulo LIKE :termo 
                OR autor LIKE :termo 
            
                OR id LIKE :termo";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':termo', '%' . $termo . '%');
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function paginateSearchposts($table, $termo, $limit, $offset)
    {


$sql = "SELECT p.* ,u.username as autor FROM  publicacao p 
                LEFT JOIN usuarios u ON p.autor = u.id 
                WHERE p.titulo LIKE :termo 
                OR u.username LIKE :termo 
                OR p.id LIKE :termo;
                LIMIT :limit OFFSET :offset";

       


   
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':termo', '%' . $termo . '%', PDO::PARAM_STR);
            $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }





}