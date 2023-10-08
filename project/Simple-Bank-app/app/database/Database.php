<?php

namespace App\database;

use PDO;
use PDOException;

class Database {
    public $db;

    public function __construct() {
        // Initialize database connection here.
        $dbHost = $_ENV['DB_HOST'];
        $dbPort = $_ENV['DB_PORT'];
        $dbName = $_ENV['DB_DATABASE'];
        $dbUsername = $_ENV['DB_USERNAME'];
        $dbPassword = $_ENV['DB_PASSWORD'];

        try {
            $this->db = new PDO("mysql:host={$dbHost};port={$dbPort};dbname={$dbName}", $dbUsername, $dbPassword);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // Use $pdo for database operations.
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
