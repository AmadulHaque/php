<?php

namespace App\customer;
use App\Models\Transaction;
use App\Models\User;

class Customer {
    private $name;
    private $email;
    private $balance;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
       $this->balance =  $this->getBalance($email);
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }


    public function deposit($amount) 
    {
        if ($amount <= 0) {
            return false; 
        }
        $this->balance += $amount;
        User::saveUserData($this->getEmail(),$this->balance);
        // Record the deposit transaction in the transaction history
        $transaction = [
            "customer_email" => $this->getEmail(),
            "type" => "deposit",
            "amount" => $amount,
            "timestamp" => date("Y-m-d H:i:s")
        ];

        Transaction::save($transaction);
        return true;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            return false; 
        }
    
        if ($amount > $this->balance) {
            return false;
        }
    
        $this->balance -= $amount; 
        User::saveUserData($this->getEmail(),$this->balance);
        // Record the withdrawal transaction in the transaction history
        $transaction = [
            "customer_email" => $this->getEmail(),
            "type" => "withdrawal",
            "amount" => $amount,
            "timestamp" => date("Y-m-d H:i:s")
        ];
        Transaction::save($transaction);
        return true;
    }


    public function transferMoney() {
        $recipientEmail = readline("Enter the recipient's email: ");
        $amount = readline("Enter the amount to transfer: ");


        // Validate recipient's email
        if (!$this->validateEmail($recipientEmail)) {
            echo "Invalid recipient email or email format. Please enter a valid email.\n";
            return;
        }
    
        // Validate amount
        if (!is_numeric($amount) || $amount <= 0) {
            echo "Invalid amount. Please enter a positive numeric value.\n";
            return;
        }
    
        // $sender = $this->currentUser;
        $recipient = $this->findOne($recipientEmail);

        if ($recipientEmail === null) {
            echo "Recipient not found. Please check the email address.\n";
            return;
        }
    
        $transferAmount = floatval($amount);

        if ($this->balance < $transferAmount) {
            echo "Insufficient balance. You do not have enough funds for this transfer.\n";
            return;
        }
        

        $this->balance -= $transferAmount;
        User::saveUserData($this->getEmail(),$this->balance);

        $balance = $this->getBalance($recipientEmail);
        $balance += $transferAmount;
        User::saveUserData($recipientEmail,$balance);

        // Record the transfer transaction in the transaction history
        $transaction = [
            "sender_email" => $this->getEmail(),
            "recipient_email" => $recipientEmail,
            "type" => "transfer",
            "amount" => $transferAmount,
            "timestamp" => date("Y-m-d H:i:s")
        ];
        Transaction::save($transaction);
        echo "Transfer successful. Your new balance is {$this->getBalance($this->getEmail())}.\n";
    }

    private function validateEmail($email) {
        if ( filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            if ($this->findOne($email) !== false) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
       
    }


    public function getBalance($email) 
    {
        $users  =  User::all();
        foreach ($users as $user) {
            if ($user["email"] == $email) {
                return $user["balance"];
            }
        }
        return false;
    }

    function findOne($email)
    {
        $users  =  User::all();
        foreach ($users as $user) {
            if ($user["email"] == $email) {
                return $user["email"];
            }
        }
        return false;
    }


}
