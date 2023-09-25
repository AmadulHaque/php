<?php

namespace App\Admin;
use App\Models\User;
use App\Transactions\AllTransaction;
class Admin {
    private $name;
    private $email;
    private AllTransaction $transaction;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
        $this->transaction = new AllTransaction();
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }



    public function seeAllCustomer()
    {
        $users  =  User::all();
        foreach ($users as $user) {
            if ($user["role"] == 2) {
                echo "Name: {$user["name"]}, Email: {$user["email"]}, Balance: {$user["balance"]}\n";
            }
        }
        return false;
    }




    public function seeAlltransactionsByUser()
    {
        $userMail = readline("Enter the user email: ");
        
        if (!$this->validateEmail($userMail)) {
            echo "Invalid user email or email format. Please enter a valid email.\n";
            return;
        }
        $this->transaction->CustomerTransactions($userMail);
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
