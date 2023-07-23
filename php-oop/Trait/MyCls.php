<?php 


require "ParentCls.php";
require "Foo.php";
require "Bar.php";


class MyCls extends ParentCls {
	use Foo, Bar;

	public function hello() {
		$this->message();
	}
}

$obj = new MyCls();
$obj->hello();