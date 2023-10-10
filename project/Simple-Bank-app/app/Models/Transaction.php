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

    public function all()
    {
      return $this->allData('transactions');
    }


    public function sum($column, $user_id)
    {
      return $this->sumData('transactions',$column,$user_id);
    }

    
    
  

    
    
}