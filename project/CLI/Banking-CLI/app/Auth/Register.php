<?php

namespace App\Auth;

class Register {

    private $dataFile = 'app/data/user.json';
    private $users = [];

    public function __construct() {
        $this->loadData();
    }

    public function registerCustomer() {
        echo "Customer Registration:\n";
        $name = readline("Enter your name: ");
        $email = readline("Enter your email: ");
        $password = readline("Enter your password: ");

        // Validate input and check if the email is unique (not already registered)
        if ($this->validateEmail($email) && $this->isEmailUnique($email)) {
            $user = [
                "name" => $name,
                "email" => $email,
                "role" => "2",
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "balance" => 0.00
            ];

            $this->users[] = $user;
            file_put_contents($this->dataFile, json_encode($this->users, JSON_PRETTY_PRINT));

            echo "Customer Registration successful. You can now login.\n";
        } else {
            echo "Registration failed. Please check your input or Email Used and try again.\n";
        }
    }

    public function registerAdmin() {
        echo "Admin Registration:\n";
        $name = readline("Enter your name: ");
        $email = readline("Enter your email: ");
        $password = readline("Enter your password: ");

        // Validate input and check if the email is unique (not already registered)
        if ($this->validateEmail($email) && $this->isEmailUnique($email)) {
            $user = [
                "name" => $name,
                "email" => $email,
                "role" => "1",
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "balance" => 0.00
            ];
            $this->users[] = $user;
            file_put_contents($this->dataFile, json_encode($this->users, JSON_PRETTY_PRINT));

            echo "Admin Registration successful. You can now login.\n";
        } else {
            echo "Registration failed. Please check your input or Email Used and try again.\n";
        }
    }


    
    private function validateEmail($email) {
        // Implement email validation logic (e.g., using filter_var)
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isEmailUnique($email) {

        if ($this->users === null) {
            echo "Error decoding JSON: " . json_last_error_msg();
        } else {
            foreach ($this->users as $customer) {
                if ($customer["email"] === $email) {
                    return false; // Email is not unique
                }
            }
        }
        return true; // Email is unique
    }


    
    private function loadData() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->users = json_decode($data, true); // Decode as an associative array
        }
    }

}
