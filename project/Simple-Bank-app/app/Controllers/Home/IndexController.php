<?php
namespace App\Controllers\Home;
use App\Models\User;
class IndexController {



    function Index()
    {
    //     $users = (new User())->get();
        
        return view('index');
    }
}