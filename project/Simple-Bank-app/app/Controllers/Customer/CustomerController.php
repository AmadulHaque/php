<?php
namespace App\Controllers\Customer;
use App\Controllers\Controller;
use App\Models\Transaction;
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
        $data = (new Transaction())->find('user_id',auth()['id']); 

        print_r($data);
        // return view('customer/dashboard',[
        //     'transactions' => $data
        // ]);
    }

    public function deposit()
    {
        return view('customer/deposit');
    }

    public function withdraw()
    {
        return view('customer/withdraw');
    }

    public function Transfer()
    {
        return view('customer/transfer');
    }

    

    //  withdrawStore TransferStore
    public function depositStore()
    {
        $data = array();
        $data['user_id'] = auth()['id'];
        $data['type'] = 1;
        $data['recipient_id'] = null;
        $data['amount'] = $_POST['amount'];
        (new Transaction())->insert($data);
        return redirect('/customer/dashboard');
    }



}