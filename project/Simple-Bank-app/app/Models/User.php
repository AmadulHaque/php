<?php

namespace App\Models;
use App\Classes\Hash;
class User extends Model
{
    
    public function insert($data)
    {
      $this->insertData('users', $data);
    }
    
  

    public function login($email)
    {
       return $this->findByEmail('users', $email);
    }

    
    
}