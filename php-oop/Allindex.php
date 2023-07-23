<?php 

	# access modifiers:
    # public - the property or method can be accessed from everywhere. This is default
    # protected - the property or method can be accessed within the class and by classes derived from that class
    # private - the property or method can ONLY be accessed within the class



#=============== Constants 
/*
    class  Student
    {
    	const ROLL = 25;
    	public function  output()
    	{
    		echo  self::ROLL;
    	}
    }
    $std = new Student();
    $std->output();

*/



#================ Inheritance and  access modifiers
/*
    class  Student
    {
    	protected $name;
    	public function __construct($name){
    		$this->name = $name;
    	}
    	public function  output()
    	{
    		echo "My name is : ".$this->name ;
    	}
    }
    class Mark extends Student
    {
    	public $roll;
    	public function  output()
    	{
    		echo "My name is : ".$this->name . " Roll :" .$this->roll;
    	}
    }
    $std = new Student("karim");
    $std->output();
    echo "<br>";
    $mark = new Mark("halim",23);
    $mark->roll = 25;
    $mark->output();
*/
# ================Inheritance check
/*
    echo "<br>";
    if ($mark instanceof Student) {
    	echo "Yes Inherit";
    }else{
    	echo "No Inherit";
    }
*/




#=============== static  
/*
    class  Student
    {
     	public static $roll = 25;
    	public function  output()
    	{
    		echo  self::$roll; if you don't  use static than  declar this code $this->roll
    	}
    }
    $std = new Student();
    $std->output();
*/




# polymorphism : When one or more classes use the same interface, it is referred to as "polymorphism" (যখন এক বা একাধিক class একই ইন্টারফেস ব্যবহার করে, তখন তাকে "পলিমরফিজম" বলা হয়)




# ============= Interfaces : Interfaces allow you to specify what methods a class should implement. (ইন্টারফেস আপনাকে নির্দিষ্ট করার অনুমতি দেয় যে কোন পদ্ধতিগুলি একটি ক্লাস বাস্তবায়ন করা উচিত।)
## যদি কোন  Interfaces ভিতরে method or property থাকে তাহলে সেটাকে তার ক্লাস এর ভিতরে implement করা লাগবে । তা না হলে ইরর  দিবে । যদিও Inherit করে অন্য একটি Interfaces এ  extends তাহলে ও implement করা লাগবে ।
/*
    interface Test 
    {
    	public  function xyz($x,$y);
    }
    class Somthing implements Test 
    {
    	public function xyz($x,$y)
    	{
    		return $x + $y;
    	}
    }
    $obj  = new Somthing();
    echo $obj->xyz(20,3);
     
    interface and  Inheritance
    interface Test 
    {
    	public  function xyz($x,$y);
    }

    interface Test1 extends Test 
    {
    	public  function abc($x,$y);
    }

    class Somthing implements Test1 
    {
    	public function xyz($x,$y)
    	{
    		return $x + $y;
    	}

    	public function abc($x,$y)
    	{
    		return $x + $y;
    	}
    }

    $obj  = new Somthing();
    echo $obj->xyz(20,3);
*/






#======================= PHP OOP - Abstract Classes  - Abstract classes and methods are when the parent class has a named method, but need its child class(es) to fill out the tasks.    (Abstract  Classes এবং পদ্ধতিগুলি হল যখন প্যারেন্ট Classes একটি নামকরণ পদ্ধতি থাকে, তবে কাজগুলি পূরণ করতে এর Child Classes (গুলি) প্রয়োজন৷)

/*
    abstract class Student
    {
        public $name;
        public function __construct($name) {
        $this->name = $name;
        }
        abstract public function result();
    }
    class Mark extends Student
    {
        public  function result(){
            return "Your Name : " . $this->name;
        }
    }
    $mark  = new Mark("karim");
    echo $mark->result();
    $markh  = new Mark("halim");
    echo $markh->result();
*/













#=============================== heard code Dependency injection 

// class  User
// {
//     protected $db;
//     function __construct(DBInterface $db)
//     {
//         $this->db = $db;
//     }

//     public  function startConnect(){
//         return $this->db->connect();
//     }
// }


// class MysqlLDB implements DBInterface
// {
//      public  function connect(){
//         return "MYSQL connect";
//      }
// }

// class PostgreSQL implements DBInterface
// {
//      public  function connect(){
//         return "PostgreSQL connect";
//      }
// }


// interface DBInterface 
// {
//     public  function connect();
// }

// $MysqlLDB = new MysqlLDB();
// $PostgreSQL = new PostgreSQL();
// $driver = new User($PostgreSQL);
// echo  $driver->startConnect();

