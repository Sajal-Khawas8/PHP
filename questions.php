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

    // function equaltotal($total, $people, $each)
    // {
    //     return $people*$each<=$total;
    // }
    // var_dump(equaltotal(5, 0, 100));


    // function length($str)
    // {
    //     if (!strlen($str)) {
    //         return 0;
    //     }
    //     return 1+length(substr($str,1));
    // }

    // echo length("");

    // function halfQuarterEighth($n)
    // {
    //     return [$n/2, $n/4, $n/8];
    // }
    // print_r(halfQuarterEighth(25));

    // function reverse($arr)
    // {
    //     $l=count($arr);
    //     for ($i=0; $i < $l; $i++) {
    //         if ($i == ceil($l/2)) {
    //             break;
    //         }
    //         $temp=$arr[$i];
    //         $arr[$i] = $arr[$l-$i-1];
    //         $arr[$l-$i-1] = $temp;
    //     }
    //     return $arr;
    // }
    // print_r(reverse([1,2,3,4,5,6]));

    // function safeBridge($bridge)
    // {
    //     str_replace(" ", " ", $bridge, $count);
    //     return $count===0;
    // }

    // var_dump(safeBridge('## ## #'));

    // function flipIntBool($bool)
    // {
    //     return $bool?0:1;
    // }

    // echo flipIntBool(0);

    // function calculateExponent($base, $exponent)
    // {
    //     return $base ** $exponent;
    // }
    // echo calculateExponent(3,3);

    // function stickers($n)
    // {
    //     return $n*$n*6;
    // }
    // echo stickers(11);

    // function fact($n)
    // {
    //     if ($n<=1) {
    //         return 1;
    //     }
    //     return $n * fact($n-1);
    // }

    // function century($year)
    // {
    //     return ceil($year/100);
    // }
    // echo century(1705);

    // function reverseAndNot($i)
    // {
    //     $org=$i;
    //     $rev=0;
    //     while ($org) {
    //         $rev=$rev*10+$org%10;
    //         $org=floor($org/10);
    //     }
    //     return $rev . $i;
    // }
    // echo reverseAndNot(152);

    // function sum($n)
    // {
    //     if ($n<=1) {
    //         return $n;
    //     }
    //     return $n+sum($n-1);
    // }
    // echo sum(12);

    // function count_d($str)
    // {
    //     return substr_count(strtolower($str), 'd');
    // }
    // echo count_d("The rodents hibernated in their den.");

    // function howManyTimes($n)
    // {
    //     return "Ed" . str_repeat('a', $n) . "bit";
    // }
    // echo howManyTimes(0);

    // function printArray($n) 
    // {
    //     $newArray = array();
       
    //     for($count = 1; $count <= $n; $count++) {
    //       $newArray[] = $count;
    //     }
        
    //     return $newArray;
    // }
    // print_r(printArray(6));

    // echo pi();

    // function otherSides($s)
    // {
    //     return [2*$s, round($s*sqrt(3), 2)];
    // }
    // print_r(otherSides(3));

    // function isLastN($str)
    // {
    //     return substr(strtolower($str), -1, 1)==='n';
    // }
    // var_dump(isLastN('Dean'));

    // function totalCups($n)
    // {
    //     return floor($n/6) + $n;
    // }
    // echo totalCups(213);

    // function circleOrSquare($r, $a)
    // {
    //     return 2*$r*pi()>=4*sqrt($a);
    // }
    // var_dump(circleOrSquare(8, 144));

    // function showdown($p1, $p2)
    // {
    //     $p1b=strpos($p1, 'Bang');
    //     $p2b=strpos($p2, 'Bang');
    //     if ($p1b < $p2b) {
    //         return "P1";
    //     } elseif ($p2b < $p1b) {
    //         return "P2";
    //     } else {
    //         return "Tie";
    //     }
    // }
    // echo showdown("     Bang!   ", "     Bang!   ");

    // function crazyFunction($n1, $n2)
    // {
    //     return $n1 ^ $n2;
    // }
    // echo crazyFunction(61, 233);

    // function addBinary($n1, $n2)
    // {
    //     return decbin($n1+$n2);
    // }
    // echo addBinary(4, 5);

    // echo strlen(78456);

    // function solveForExp($b, $n)
    // {
    //     return log($n, $b);
    // }
    // echo solveForExp(9, 3486784401);

    // function concatArray($arr1, $arr2)
    // {
    //     return array_merge($arr1,$arr2);
    // }
    // print_r(concatArray([1,2,3],[4,5,6]));

    // function leapYear($year)
    // {
    //     return ($year%4===0 && $year%100!==0) || ($year%100===0 && $year%400===0);
    // }
    // var_dump(leapYear(2100));

    // function search($arr, $v)
    // {
    //     return array_search($v, $arr);
    // }
    // echo search([1, 5, 3], 3);

    // function walls($n, $w, $h)
    // {
    //     return floor($n/($w*$h));
    // }
    // echo walls(1,1,1)

    // function squareAreasDifference($r)
    // {
    //     return ($r*2)*($r*2)-($r*2)*($r*2)/2;
    // }
    // echo squareAreasDifference(17);

    // function sumCubes($n)
    // {
    //     if ($n==1) {
    //         return 1;
    //     }
    //     return $n**3 + sumCubes($n-1);
    // }

    // echo sumCubes(9);

    // print_r(range(1, 5));

    // function repeat($item, $times)
    // {
    //     return array_pad([], $times, $item);
    // }
    // print_r(repeat(13, 5));

    // print_r(str_split("c++", 2));

    // function reverseNum($n)
    // {
    //     $n=abs($n);
    //     $rev=0;
    //     while ($n) {
    //         $rev=$rev*10+($n%10);
    //         $n=floor($n/10);
    //     }
    //     return $rev;
    // }
    // echo reverseNum(123);
    // echo strrev(abs(123));

    // function sine($n1, $n2)
    // {
    //     return round($n1 * sin($n2*pi()/180), 2);
    // }
    // function cosine($n1, $n2)
    // {
    //     return round($n1 * cos($n2*pi()/180), 2);
    // }
    // function tangent($n1, $n2)
    // {
    //     return round($n1 * tan($n2*pi()/180), 2);
    // }
    // echo sine(8, 27), "\n", cosine(10, 4), "\n", tangent(4, 39);

    function notNotNot($n, $bool)
    {
        return ($n%2 xor $bool);
    }
    var_dump(notNotNot(5,false));
?>