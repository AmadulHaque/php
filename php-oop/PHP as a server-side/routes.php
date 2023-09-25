<?php

require_once 'Router.php';



Router::get('user',function(){
    (new UserController())->getUserPage();
 });
 

 Router::post('user', function() {
    $data = [
        'name' => $_POST['name']
    ];
    (new UserController())->storeUserData($data);
});




Router::get('contact', function() {
    echo "Contact page";
});