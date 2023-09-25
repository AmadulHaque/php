<?php

namespace App\Models;

class User {

    public static $dataFile = 'app/data/user.json';
    public static  $users = [];



    public static function all() {
        if (file_exists(self::$dataFile)) {
            $data = file_get_contents(self::$dataFile);
            self::$users  = json_decode($data, true);
        }
        return self::$users;
    }



    public static function save($data)
    {
        self::all();
        self::$users[] = $data;
        $data = json_encode(self::$users, JSON_PRETTY_PRINT);
        file_put_contents(self::$dataFile, $data);
    }


    public static function saveUserData($email,$amount) {
        $users  = self::all();
        foreach ($users as &$user) {
            if ($user["email"] === $email) {
                $user["balance"] = $amount;
                break;
            }
        }
        $data = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents(self::$dataFile, $data);
    }


}