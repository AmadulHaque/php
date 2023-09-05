<?php

class Database {

    public function __construct() {
        $this->vdbconnect();
    }

    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;

    public $link;
    public $error;

    public function dbconnect()
    {
        $this->mysqli_connect($this->host,$this->user,$this->password ,$this->database);    
        if (!$this->link) {
            $this->error = 'Database Connection Faild';
            return false;
        }
    }



    // select query
    public function select($query)
    {
        $result = mysqli_query($this->link,$query) or die($this->link->error._LIKE_);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }else{
            return false;
        }
    }


    // insert query
    public function insert($query)
    {
        $result = mysqli_query($this->link,$query) or die($this->link->error._LIKE_);
        if ($result > 0) {
            return $result;
        }else{
            return false;
        }
    }

        // update query
        public function update($query)
        {
            $result = mysqli_query($this->link,$query) or die($this->link->error._LIKE_);
            if ($result> 0) {
                return $result;
            }else{
                return false;
            }
        }

        // delete query
        public function delete($query)
        {
            $result = mysqli_query($this->link,$query) or die($this->link->error._LIKE_);
            if ($result> 0) {
                return $result;
            }else{
                return false;
            }
        }


}