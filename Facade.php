<?php

class  Sample {

  public  function sayHello()
  {
    echo "Hello";
  }

  public  function sayWow()
  {
    echo "Wow!";
  }

}



class SampleFacade
{
    public static function __callStatic($name, $arguments)
    {
      return (new Sample())->{$name}(...$arguments);
    }
}

SampleFacade::sayWow();
