<?php

class Facades {
    

    public function sayHello()
    {
        echo "Hello";    
    }

    public function sayWow()
    {
        echo "Wow";    
    }

}


class SampleFacades {

    public static function __callStatic($name, $arguments)
    {
          (new Facades())->{$name}(...$arguments);
    }

}


SampleFacades::sayHello();
