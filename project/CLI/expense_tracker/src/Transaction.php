<?php

class Transaction
{
    public $id;
    public $category;
    public $description;
    public $amount;

    public function __construct($category, $description, $amount)
    {
        $this->id = uniqid();
        $this->category = $category;
        $this->description = $description;
        $this->amount = $amount;
    }
}
