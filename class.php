<?php

class A{
    static $x=5;
    public $y=10;
}

$obj=new A();
echo "Static Variable: " . A::$x;
echo "\nNon Static Variable: " . $obj->y;