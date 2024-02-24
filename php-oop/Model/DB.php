<?php


// class Database {

//     public $db;
    
//     public function __construct() {
//         // Initialize database connection here.
//         $hostname = "localhost";
//         $username = "intrade_apu";
//         $password = "Q04+o%?(!!f^";
//         $db_name='supermom';
//         define('URL_NAME','http://'.$_SERVER['HTTP_HOST']);

//         try {
//             // Create connection
//             $this->db = mysqli_connect($hostname, $username, $password,$db_name);
//             echo "Database connection Success";
//         } catch (PDOException $e) {
//             die("Database connection failed: " . $e->getMessage());
//         }
//     }
// }

class Database {
    public $db;

    public function __construct() {
        $hostname = "localhost";
        $username = "intrade_apu";
        $password = "Q04+o%?(!!f^";
        $db_name = 'supermom';

        $this->db = new mysqli($hostname, $username, $password, $db_name);

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        } else {
            // echo "Database connection Success";
        }
    }
}


