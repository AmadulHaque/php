<?php 


require 'Vehicle.php';

class Car implements Vehicle {
	public function display() {
		return 'Welcome';
	}
	public function capcity() {
		return 10;
	}
	public function fuelAmount() {
		return 12;
	}
}

$car = new Car();
echo "Capacity  = ". $car->capcity();

echo "<br/>";


echo "fuelAmount = ". $car->fuelAmount();


 ?>