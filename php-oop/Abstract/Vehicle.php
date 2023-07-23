<?php 

abstract class  Vehicle {
	public function display(){
		return "welcome";
	}
	abstract public function capcity();
	abstract public function fuelAmount();
}

