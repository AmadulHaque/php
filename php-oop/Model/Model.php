<?php

include('DB.php');

class Model extends Database {

    public $query;
    protected $select = '*';
    protected $currentPage = 1;

    public function __construct() {
        parent::__construct();
        $this->query = "SELECT {$this->select} FROM {$this->table} ";
        $this->countQuery = "SELECT COUNT(*) FROM {$this->table}";
        $this->currentPage = $_GET['page'] ?? 1;
    }

    // Additional methods for dynamic query building
    public function where($column, $operator, $value, $MainOperator=null, $column2=null, $operator2=null, $value2=null) {
        $this->query .= " WHERE $column $operator '$value'";
        $this->countQuery .= " WHERE $column $operator '$value'";
        if ($MainOperator) {
            $this->query .= " $MainOperator $column2 $operator2 '$value2'";
            $this->countQuery .= " $MainOperator $column2 $operator2 '$value2'";
        }
        return $this;
    }

    public function and($column, $operator, $value) {
        $this->query .= " AND $column $operator '$value'";
        $this->countQuery .= " AND $column $operator '$value'";
        return $this;
    }

    public function limit($limit) {
        $this->query .= " LIMIT $limit";
        return $this;
    }


    public function select($columns = array('*')) {
        if (is_array($columns)) {
            $this->select = implode(', ', $columns);
        } else {
            $this->select = $columns;
        }
        $this->query = "SELECT {$this->select} FROM {$this->table} ";
        return $this;
    }

    // Method to execute a query
    protected function executeQuery($sql) {
        $this->_error = false;
        $this->_results = null;
        $result = $this->db->query($sql);

        if ($result) {
            $this->_results = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->_error = true;
        }
        return $this;
    }


    // Method to execute a query
    protected function executeCountQuery($sql) {
        $this->_error = false;
        $this->_results = null;
        $result = $this->db->query($sql);

        if ($result) {
            $this->_results = $result->fetch_assoc()['COUNT(*)'];
        } else {
            $this->_error = true;
        }
        return $this;
    }



    public function join($addresses, $joinCondition) {
        $this->query .= " JOIN $addresses ON $joinCondition";
        $this->countQuery .= " JOIN $addresses ON $joinCondition";
        return $this;
    }

    // Method to paginate the query results
    public function paginate($perPage=10) {
        $offset = ($this->currentPage - 1) * $perPage;
        $this->query .= " LIMIT {$perPage} OFFSET {$offset}";
        $this->executeQuery($this->query);
        $data = $this->_results ?? [];
        $this->executeCountQuery($this->countQuery);
        $totalCount = $this->_results;

        print_r($this->query);

        $totalPages = ceil($totalCount / $perPage);
        return ['data' => $data, 'current_page'=>$this->currentPage , 'total_pages' => $totalPages, 'total_count' => $totalCount];
    }


    // Method to retrieve results
    public function get() {
        $this->executeQuery($this->query);
        return $this->_results;
    }

    // Method to retrieve the first result
    public function first() {
        $this->executeQuery($this->query);
        return isset($this->_results[0]) ? $this->_results[0] : null;
    }

    // Method to retrieve the count of results
    public function count() {
        $this->executeCountQuery($this->countQuery);
        return $this->_results;
    }

    // Method to check for errors
    public function error() {
        $this->executeQuery($this->query);
        return $this->_error;
    }


}
?>
