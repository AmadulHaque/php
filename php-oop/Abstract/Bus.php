<?php 
require 'Vehicle.php';

class Bus extends Vehicle {
	public function capcity() {
		return 15;
	}
	public function fuelAmount() {
		return 25;
	}
} 

$bus = new Bus();
echo $bus->capcity();