<?php
require_once 'vendor/autoload.php';


use App\Auth\Register;
use App\Auth\Login;
use App\Transactions\AllTransaction;
class CreateAdmin {
    
    private Register $register;
    private Login $login;
    private AllTransaction $transaction;

    public function __construct() {
        $this->register = new Register();
        $this->login = new Login();
        $this->transaction = new AllTransaction();
    }

    public function run() {
        echo "Welcome to the Banking App CLI!\n";

        while (true) {
            if ($this->login->currentUser === null) {
                $this->showAuthenticationMenu();
            } else {
                if ($this->login->currentUser instanceof Admin\Admin) {
                    $this->showAdminMenu();
                } elseif ($this->login->currentUser instanceof Customer\Customer) {
                    $this->showCustomerMenu();
                }
            }
        }
    }

    private function showAuthenticationMenu() {
        echo "1. Login\n";
        echo "2. Register\n";
        echo "0. Exit\n";

        $choice = readline("Enter your choice: ");

        switch ($choice) {
            case '1':
                $this->login->login();
                break;
            case '2':
               $this->register->registerAdmin();
                break;
            case '0':
                exit("Goodbye!\n");
            default:
                echo "Invalid choice. Please try again.\n";
        }
    }


    private function showAdminMenu() {
        echo "Admin Menu:\n";
        echo "1. See all transactions by all users\n";
        echo "2. See transactions by a specific user\n";
        echo "3. See the list of all customers\n";
        echo "0. Logout\n";

        $choice = readline("Enter your choice: ");

        switch ($choice) {
            case '1':
                $this->transaction->seeAllTransactions();
                break;
            case '2':
                $this->login->currentUser->seeAlltransactionsByUser();
                break;
            case '3':
                $this->login->currentUser->seeAllCustomer();
                break;
            case '0':
                $this->login->currentUser = null;
                echo "Logged out.\n";
                break;
            default:
                echo "Invalid choice. Please try again.\n";
        }
    }

    private function showCustomerMenu() {
        echo "Customer Menu:\n";
        echo "1. See all transactions\n";
        echo "2. Deposit money\n";
        echo "3. Withdraw money\n";
        echo "4. Transfer money\n";
        echo "5. See current balance\n";
        echo "0. Logout\n";

        $choice = readline("Enter your choice: ");

        switch ($choice) {
            case '1':
                $this->transaction->CustomerTransactions($this->login->currentUser->getEmail());
                break;
            case '2':
                $this->depositMoney();
                break;
            case '3':
                $this->withdrawMoney();
                break;
            case '4':
                $this->login->currentUser->transferMoney();
                break;
            case '5':
                
                echo " Your Current balance is {$this->login->currentUser->getBalance($this->login->currentUser->getEmail())}.\n";
                break;
            case '0':
                $this->login->currentUser = null;
                echo "Logged out.\n";
                break;
            default:
                echo "Invalid choice. Please try again.\n";
        }
    }




    // customer method
    public function depositMoney() {
        $amount = readline("Enter the amount to deposit: ");
        if (!is_numeric($amount) || $amount <= 0) {
            echo "Invalid amount. Please enter a positive numeric value.\n";
            return;
        }
    
        $result = $this->login->currentUser->deposit(floatval($amount));
    
        if ($result) {
            echo "Deposit successful \n";
        } else {
            echo "Deposit failed. Please check the deposit amount.\n";
        }
    }

    public function withdrawMoney() {
        $amount = readline("Enter the amount to withdraw: ");
        if (!is_numeric($amount) || $amount <= 0) {
            echo "Invalid amount. Please enter a positive numeric value.\n";
            return;
        }
    
        $result = $this->login->currentUser->withdraw(floatval($amount));
    
        if ($result) {
            echo "Withdrawal successful. Your new balance is {$this->login->currentUser->getBalance()}.\n";
        } else {
            echo "Withdrawal failed. Please check the withdrawal amount or your balance.\n";
        }
    }


   
    










}

$app = new CreateAdmin();
$app->run();
