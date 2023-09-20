<?php


class Driver
{
	protected Vehicle $vehicle;

	function __construct(Vehicle $vehicle)
	{
		$this->vehicle = $vehicle;
	}


	public function startRide()
	{
		$this->vehicle->start();
	}


}




class Vehicle 
{
	public Engine $engine;

	public function __construct(Engine $engine)
	{
		$this->engine = $engine();
	}
	
}


class Engine 
{



}

$engine = new Engine();
$vehicle = new Vehicle($engine);
$driver = new Driver($vehicle);