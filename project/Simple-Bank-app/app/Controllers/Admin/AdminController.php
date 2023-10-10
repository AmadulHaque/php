<?php
namespace App\Controllers\Admin;
use App\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Classes\Session;
use App\Classes\Validate;
use App\Classes\Hash;

class AdminController extends Controller
{
    public function __construct() {
       if (auth()==false) {
        redirect('/login');
       }
    }

    public function Index()
    {

        $users = (new User())->all(); 
        return view('admin/customers',[
            'users'=>$users
        ]);
    }
    
    public function CustomerAdd()
    {

        return view('admin/add_customer');
    }
    
    
    public function CustomerStore()
    {
        $validate = new Validate();
        $validate->check($_POST, array(
            'name' => array('required' => true),
            'email' => array('required' => true),
            'phone' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validate->passed()) {
            // Validate the input data
            
            $data = $_POST;
    
            // Change the password to a new value
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
       
            // Create a new User model instance and insert the user data
            (new User())->insert($data);

            // Redirect the user to the login page or any other appropriate page
            return redirect('/admin/dashboard',['message'=>"Registration successful. You can now login"]);
        } else {
            return view('admin/add_customer',[
                'errors' => $validate->errors()
            ]);
        }
    }
    


    public function CustomerTransactions()
    {
        if ($_GET) {
            $transactions = (new Transaction())->find($_GET['id']); 
            return view('admin/customer_transactions',[
                'transactions' => $transactions,
            ]);
        }else{ 
            $users = (new User())->all(); 
            return view('admin/transactions',[
                'users' => $users,
            ]);
        }
    }



   
}