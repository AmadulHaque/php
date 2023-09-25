<?php

namespace App\Models;

class Transaction {

    public static $dataFile = 'app/data/transaction.json';
    public static $transactions = [];

    public function __construct() {
        self::all();
        
    }

    public static function all() {
        if (file_exists(self::$dataFile)) {
            $data = file_get_contents(self::$dataFile);
            self::$transactions  = json_decode($data, true);
        }
        return self::$transactions;
    }

    public static function save($data)
    {
        self::$transactions[] = $data;
        $data = json_encode(self::$transactions, JSON_PRETTY_PRINT);
        file_put_contents(self::$dataFile, $data);
    }



}