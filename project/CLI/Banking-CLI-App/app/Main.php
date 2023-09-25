<?php

namespace App;
use App\Classes\Auth\Login;
use App\Classes\Auth\Register;

class Main
{
    // private FinanceManager $financeManager;
    private $register;
 
    private const LOGIN = 1;
    private const REGISTER = 2;

    private array $options = [
        self::LOGIN => 'Login',
        self::REGISTER => 'Register',
    ];

    public function __construct()
    {
        $this->register = new Register();

    }

    public function run(): void
    {
        while (true) {
            foreach ($this->options as $option => $label) {
                printf("%d. %s\n", $option, $label);
            }

            $choice = intval(readline("Enter your option: "));

            switch ($choice) {
                case self::LOGIN:
                    $email = trim(readline("Enter email: "));
                    $password = trim(readline("Enter password: "));
                    break;
                case self::REGISTER:
                    $name = trim(readline("Enter name: "));
                    $email = trim(readline("Enter email: "));
                    $password = trim(readline("Enter password: "));
                    break;
                default:
                    echo "Invalid option.\n";
            }
        }
    }
}