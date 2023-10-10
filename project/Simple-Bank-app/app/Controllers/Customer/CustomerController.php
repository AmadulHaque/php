<?php
namespace App\Controllers\Customer;
use App\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Classes\Session;

class CustomerController extends Controller
{
    public function __construct() {
       if (auth()==false) {
        redirect('/login');
       }
    }

    public function Index()
    {
        $data = (new Transaction())->find(auth()['id']); 

        // var_dump($data);
        $amount = (new User())->login(auth()['email'])['amount'];
        return view('customer/dashboard',[
            'transactions' => $data,
            'amount'=>$amount
        ]);
    }

    public function deposit()
    {
        $amount = (new User())->login(auth()['email'])['amount'];
        return view('customer/deposit',[
            'amount'=>$amount
        ]);
    }

    public function withdraw()
    {
        $amount = (new User())->login(auth()['email'])['amount'];
        return view('customer/withdraw',[
            'amount'=>$amount
        ]);
    }

    public function Transfer()
    {
        $amount = (new User())->login(auth()['email'])['amount'];
        $users = (new User())->all();
        return view('customer/transfer',[
            'amount'=>$amount,
            'users'=>$users
        ]);
    }

    

    //  withdrawStore TransferStore
    public function TransactionStore()
    {
        $email = Session::get('token');
        $user =  (new User())->login($email['email']);
        $data = array();
        $userData = array();
        if ($_POST['type']==1) {
            $data['user_id'] = auth()['id'];
            $data['type'] =  $_POST['type'];
            $data['recipient_id'] = null;
            $data['amount'] = $_POST['amount'];
            $userData['amount'] = $user['amount'] + $_POST['amount'];
            
        }else if($_POST['type']==2){

            $data['user_id'] = auth()['id'];
            $data['type'] =  $_POST['type'];
            $data['recipient_id'] = null;
            $data['amount'] = $_POST['amount'];
            $userData['amount'] = $user['amount'] - $_POST['amount'];
        }else{
            $data['user_id'] = auth()['id'];
            $data['type'] =  $_POST['type'];
            $data['recipient_id'] = $_POST['recipient_id'];
            $data['amount'] = $_POST['amount'];
            $userData['amount'] = $user['amount'] - $_POST['amount'];
        }
        (new Transaction())->insert($data);
       

        $users = (new User())->update($userData,auth()['id']);
        return redirect('/customer/dashboard');
    }

    



}