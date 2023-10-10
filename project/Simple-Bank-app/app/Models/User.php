<?php

namespace App\Models;
use App\Classes\Hash;
class User extends Model
{
    
    public function insert($data)
    {
      $this->insertData('users', $data);
    }
    
  
    public function all()
    {
      return $this->allData('users');
    }

      
    public function update($data,$id)
    {
      return $this->updateData('users', $data, $id);
    }


    public function login($email)
    {
       return $this->findByEmail('users', $email);
    }
    
    
    
}