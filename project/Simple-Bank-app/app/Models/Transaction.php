<?php

namespace App\Models;

class Transaction extends Model
{
    
    public function insert($data)
    {
     return $this->insertData('transactions', $data);
    }


    public function find($id)
    {
      return $this->findByData('transactions',$id);
    }
    
  

    
    
}