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
    public function selectAllUser($table)
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

    //função para contar quantidade de elemntos na tabela
    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) AS total FROM {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function paginate($table, $limit, $offset)
    {
        $sql = "SELECT * FROM {$table} LIMIT {$limit} OFFSET {$offset}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // isso aqui, como marcos tinha dito em aguma daily, foi meioque copia e cola da documentação,
    // mas tive  que adaptar pro contexto do DB nosso

    //Função pra pegar info do banco de dados
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
        $sql = sprintf('SELECT * FROM %s WHERE id=:id LIMIT 1', $table);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($table, $id, $parameters)
    {
        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = %s',
            $table,
            implode(', ', array_map(function ($param) {
                return $param . ' = :' . $param;
            }, array_keys($parameters))),
            $id
        );
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
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
    public function verificaLogin($email, $senha)
    {

        $sql = sprintf('SELECT * FROM  usuarios WHERE email = :email AND senha = :senha');

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'senha' => $senha
            ]);

            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s)',
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
        $sql = sprintf(
            'DELETE FROM %s WHERE %s',
            $table,
            'id = :id'
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

// funcaozinha pra contar os resultados
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
}
