<?php



// autoload 
require_once __DIR__ . "/../vendor/autoload.php"; 


// request
$request = $_SERVER['REQUEST_URI'];
$request = explode("?", $request)[0];


 

// call routes
require_once  __DIR__ . "/../routes/web.php";

