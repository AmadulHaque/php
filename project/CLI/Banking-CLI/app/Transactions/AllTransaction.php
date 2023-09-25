<?php

namespace App\Transactions;

use App\Models\Transaction;

class AllTransaction {

    public function __construct( ) {
        
    }
    
    public function seeAllTransactions() {

        $transactions = Transaction::all();
        echo "Transaction History :\n";
        foreach ($transactions as $transaction) {
            if ($transaction["type"]=="transfer") {
                echo "Type: {$transaction["type"]}, Sender Email: {$transaction["sender_email"]}, Recipient Email: {$transaction["recipient_email"]}, Amount: {$transaction["amount"]}, Timestamp: {$transaction["timestamp"]}\n";
            }else{
                echo "Type: {$transaction["type"]}, Amount: {$transaction["amount"]}, Timestamp: {$transaction["timestamp"]}\n";
            }
        } 

    }

    public function CustomerTransactions($email) {
        $transactions = Transaction::all();
        echo "Transaction History for {$email}:\n";
        if($transactions == null){
            return false;
        }else{
            foreach ($transactions as $transaction) {
                if ($transaction["type"]=="transfer" &&  ($transaction["sender_email"] === $email || $transaction["recipient_email"] === $email) ) {
                    echo "Type: {$transaction["type"]}, Sender Email: {$transaction["sender_email"]}, Recipient Email: {$transaction["recipient_email"]}, Amount: {$transaction["amount"]}, Timestamp: {$transaction["timestamp"]}\n";
                }else if (isset($transaction["customer_email"]) && $transaction["customer_email"] === $email) {
                    echo "Type: {$transaction["type"]}, Amount: {$transaction["amount"]}, Timestamp: {$transaction["timestamp"]}\n";
                }
            }  
        }
 
    }






}