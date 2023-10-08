<?php
require_once 'Router.php';

use App\Controllers\Auth\AuthController;
use App\Controllers\Home\IndexController;
use App\Controllers\Customer\CustomerController;




Router::get('/', [IndexController::class,"Index"]);
Router::get('/login', [AuthController::class,"login"]);
Router::post('/login', [AuthController::class,"loginPost"]);
Router::get('/register', [AuthController::class,"Register"]);
Router::post('/register/post', [AuthController::class,"RegisterPost"]);
Router::get('/logout', [AuthController::class,"logout"]);


//customer 
Router::get('/customer/dashboard', [CustomerController::class,"Index"]);
Router::get('/customer/deposit', [CustomerController::class,"deposit"]);
Router::get('/customer/withdraw', [CustomerController::class,"withdraw"]);
Router::get('/customer/transfer', [CustomerController::class,"Transfer"]);

//  post
Router::post('/customer/deposit', [CustomerController::class,"depositStore"]);
Router::post('/customer/withdraw', [CustomerController::class,"withdrawStore"]);
Router::post('/customer/transfer', [CustomerController::class,"TransferStore"]);
