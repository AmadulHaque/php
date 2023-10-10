<?php

namespace App\Models;

use App\database\Database;
use PDO;

class Model extends Database {
    private $_query,
            $_error = false,
            $_results,
            $_count = 0;

 



    public function query($sql, $params = array()) 
    {
        $this->_error = false;

        if($this->_query = $this->db->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }

        }
        return false;
    }


    public  function insertData($table, $fields = array()) {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;
        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }
        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }



    public function updateData($table, $fields = array(), $id = '') {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;
        $setClauses = array();

        foreach ($fields as $field => $value) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
            $setClauses[] = "`{$field}` = ?";
        }

        $sql = "UPDATE {$table} SET " . implode(', ', $setClauses);

        if (!empty($whereCondition)) {
            $sql .= " WHERE id={$id}";
        }

        $values = array_values($fields);
        
        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }



  


    public function findByEmail($table, $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$table} WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            return false;
        }
        return $user;
    }

    
    
    public function findByData($table, $user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE user_id = :user_id");

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return [];
        }
        return $data;
    }
    
    public function sumData($table, $column, $user_id)
    {
        $stmt = $this->db->prepare("SELECT SUM({$column}) as total FROM {$table} WHERE user_id = :user_id");

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result || !isset($result['total'])) {
            return 0;
        }

        return (float) $result['total'];
    }

    public function allData($table)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$table};");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function results() {
        return $this->_results;
    }

    public function first() {
        $data = $this->results();
        return $data[0];
    }

    public function count() {
        return $this->_count;
    }

    public function error() {
        return $this->_error;
    }

    
}
