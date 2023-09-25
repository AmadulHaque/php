<?php

namespace App\Auth;
use App\Admin\Admin;
use App\customer\Customer;
class Login {

    private $dataFile = 'app/data/user.json';
    private $users = [];
    public $currentUser = null;
    public function __construct() {
        $this->loadData();
    }

  
    public function login() {
        echo "Login:\n";
    
        $email = readline("Enter your email: ");
        $password = readline("Enter your password: ");
    
        if ($this->validateEmail($email)) {
            
    
            foreach ($this->users as $user) {
                if ($user["email"] === $email && password_verify($password, $user["password"])) {
                    // Successful login
                    if ($this->isAdmin($email)) {
                        // Set the current user as an Admin
                        $this->currentUser = new Admin($user["name"],$email);
                    } else {
                        // Set the current user as a Customer
                        $this->currentUser = new Customer($user["name"],$email);
                    }
                    echo "Login successful. Welcome, " . $user["name"] . "!\n";
                    return;
                }
            }
        }
    
        echo "Login failed. Please check your email and password.\n";
    }
    
    private function validateEmail($email) {
        // Implement email validation logic (e.g., using filter_var)
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isAdmin($email) {
        // Check if the provided email belongs to an Admin
        foreach ($this->users as $user) {
            if ($user["email"] === $email && $user['role']==1 ) {
                return true;
            }
        }
        return false;
    }




    
    private function loadData() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->users = json_decode($data, true); // Decode as an associative array
        }
    }

}
