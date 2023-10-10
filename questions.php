<?php
// function stutter($word) {
    //     $twoChars = substr($word, 0, 2);
    //     return "$twoChars...$twoChars...$word?";
    // }
    // echo  stutter("incredible");

    // function isEmpty($str) {
    //     return !(strlen($str)===0);
    // }

    // var_dump(isEmpty(""));

    // function animals($chick, $cow, $pigs)
    // {
    //     return $chick * 2 + $cow * 4 + $pigs * 4;
    // }
    // echo animals(2, 3, 5);

    // function sum($n1, $n2)
    // {
    //     return $n1+$n2<100;
    // }
    // var_dump(sum(40, 50));

    // function frames($a, $b)
    // {
    //     return $a*$b*60;
    // }
    // echo frames(10, 25);

    // function yearsInOneHouse($age, $moves)
    // {
    //     return round($age / ($moves+1));
    // }
    // echo yearsInOneHouse(1, 0);

    // function smallerNum($n1, $n2)
    // {
    //     return min($n1, $n2);
    // }
    // echo smallerNum("5", "5");

    // function toInt($n)
    // {
    //     return intval($n);
    // }
    // function toStr($n)
    // {
    //     return strval($n);
    // }
    // var_dump(toStr(17));

    // function convert($h, $m)
    // {
    //     return $h*60*60 + $m*60;
    // }
    // echo convert(0, 30);

    // function calculateFuel($dist){
    //     $fuel=$dist*10;
    //     return $fuel<100?100:$fuel;
    // }
    // echo calculateFuel(3.14);

    // function calcAge($age)
    // {
    //     return $age*365;
    // }
    // echo calcAge(20);

    // function footballPoints($wins, $draws, $loss)
    // {
    //     return $wins*3 + $draws;
    // }
    // echo footballPoints(0, 0, 1);

    // function boolToStr($flag)
    // {
    //     return strval($flag);
    // }
    // var_dump(boolToStr(false));

    // function reverseCapitalize($str)
    // {
    //     return strtoupper(strrev($str));
    // }
    // echo reverseCapitalize('Hello World');

    // function arrayToString($arr)
    // {
    //     return implode('', $arr);
    // }
    // echo arrayToString([1, 2, 3, 4, 5, 6]);

    // function arraySum($arr)
    // {
    //     return array_sum($arr)%2===0?"Even":"Odd";
    // }
    // echo arraySum([1, 2, 3, 4, 5, 6]);

    function equaltotal($total, $people, $each)
    {
        return $people*$each<=$total;
    }
    var_dump(equaltotal(5, 0, 100));

?>