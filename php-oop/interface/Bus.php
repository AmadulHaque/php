<?php 

	require 'Vehicle.php';

	class Bus implements Vehicle {
		public function display() {
			return 'Welcome';
		}
		public function capcity() {
			return 15;
		}
		public function fuelAmount() {
			return 25;
		}
		public function applyBreaks() {
			return 'Breaked';
		}
	}

$bus = new Bus();
echo "capcity = ". $bus->capcity();

echo "<br/>";

echo "fuelAmount = ". $bus->fuelAmount();

