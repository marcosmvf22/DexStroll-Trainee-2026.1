<?php

namespace App\Core\Database;

use PDO, Exception;
// consegui usar as parada
// de classe para importar pdo, igual o usenamespace do C++ para nao ter que escrever std::  toda hora
// aqui acho  que  funcionou igual
class QueryBuilder
{
    protected $pdo;
// aqui meio que  faz o método  construir de dentro pra fora, apenas  de  classe  herdada, para nao ter problema de hierarquia de certa forma
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // pra nao terque pegar um  por um,   aqui retorna a tabela inteira
    public function selectAll($table)
    {
        $sql = "select * from {$table}";
// try-catch pra naodar pau se der erro, e voltar "die"e parar
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
            // paradinha pra voltar  igual array mesmo,  mais facild de  manipular os datas
            // como  se cada coluna fosse retornada de propriedade de objeto
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
// isso aqui, como marcos tinha dito em aguma daily, foi meioque copia e cola da documentação,
// mas tive  que adaptar pro contexto do DB nosso
    
    public function selectWhere($table, $where)
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

    // tem coisa aqui que  sinceramente nao sei se era necessário, mas ajuda na hora
    public function insert($table, $data)
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

//    implementar  no JS
    public function update($table, $data, $where)
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
// aq ta  meio caminhho andado, só falta implementar a comunicação do front pra isso funcionar
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

//    aqui  tbm, implementar no JS, porque ta meio caminho...
    public function delete($table, $where)
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

//aqui ta assim, mas dependendoquecomo comportar, tem que mexer, só o  criar ta funcionando por enquanto mesmo.
    public function selectOne($table, $where)
    {
        $result = $this->selectWhere($table, $where);
        return $result ? $result[0] : null;
    }
}