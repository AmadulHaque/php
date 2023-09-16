<?php

class ExpenseTracker
{
    private $transactions = [];
    private $dataFile = 'data/transactions.json';

    public function __construct()
    {
        $this->loadData();
    }

    public function addTransaction($category, $description, $amount)
    {
        $transaction = new Transaction($category, $description, $amount);
        $this->transactions[] = $transaction;
        $this->saveData();
    }

    public function viewTransactions()
    {
        foreach ($this->transactions as $transaction) {
            echo "ID: {$transaction->id}\n";
            echo "Category: {$transaction->category}\n";
            echo "Description: {$transaction->description}\n";
            echo "Amount: {$transaction->amount}\n";
            echo "--------------------------\n";
        }
    }

    private function loadData()
    {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->transactions = json_decode($data);
        }
    }

    private function saveData()
    {
        $data = json_encode($this->transactions, JSON_PRETTY_PRINT);
        file_put_contents($this->dataFile, $data);
    }
}
