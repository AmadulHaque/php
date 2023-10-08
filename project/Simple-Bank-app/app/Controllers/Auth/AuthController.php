<?php
namespace App\Controllers\Auth;
use App\Controllers\Controller;
use App\Models\User;
use App\Classes\Validate;
use App\Classes\Hash;
use App\Classes\Session;

class AuthController extends Controller
{
    public function __construct() 
    {
        // $user = auth();
        // if (auth()==false) {
        // }else{
        //     if (auth()['role']==2) {
        //         redirect('/customer/dashboard');
        //     }else{
        //         redirect('/admin/dashboard');
        //     }
        // }
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost()
    {
        $validate = new Validate();
        $validate->check($_POST, array(
            'email' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validate->passed()) {
            
            $user =  (new User())->login($_POST['email']);
            if ($user) {
                if(Hash::check($_POST['password'], $user['password'])) {
                    Session::put('token', $user);
                    if ($user['role']==1) {
                        // return admin panel
                    }else{
                        return redirect('/customer/dashboard',['message'=>"login successful."]);
                    }
                    return true;
                }else{
                    return view('login',[
                        'errors' => array('email' => 'Invalid Your Password.')
                    ]);
                }
            }else{
                return view('login',[
                    'errors' => array('email' => 'Invalid Your Email. ')
                ]);
            }
            
        } else {
            return view('login',[
                'errors' => $validate->errors()
            ]);
        }
    }

    public function Register()
    {
        return view('register');
    }

    public function registerPost()
    {
        
        $validate = new Validate();
        $validate->check($_POST, array(
            'name' => array('required' => true),
            'email' => array('required' => true),
            'phone' => array('required' => true),
            'address' => array('required' => true),
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
            return redirect('/login',['message'=>"Registration successful. You can now login"]);
        } else {
            return view('register',[
                'errors' => $validate->errors()
            ]);
        }
    }


    public function logout()
    {
        Session::delete('token');
        return redirect('/login',['message'=>"Logout successful"]);
    }
    


}
