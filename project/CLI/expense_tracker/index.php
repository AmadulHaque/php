<?php

require 'src/ExpenseTracker.php';
require 'src/Transaction.php';

$expenseTracker = new ExpenseTracker();

while (true) {
    echo "Expense Tracker CLI\n";
    echo "1. Add Transaction\n";
    echo "2. View Transactions\n";
    echo "3. Exit\n";
    $choice = readline("Enter your choice: ");

    switch ($choice) {
        case '1':
            $category = readline("Enter category: ");
            $description = readline("Enter description: ");
            $amount = readline("Enter amount: ");
            $expenseTracker->addTransaction($category, $description, $amount);
            echo "Transaction added!\n";
            break;
        case '2':
            echo "All Transactions:\n";
            $expenseTracker->viewTransactions();
            break;
        case '3':
            exit("Goodbye!\n");
        default:
            echo "Invalid choice. Please try again.\n";
    }
}
