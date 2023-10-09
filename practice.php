<?php

// $arr=['a','b','c'];


// Q1:
// phpinfo();

// Q2:
// echo "Tomorrow I'll learn PHP global variables.\n";
// echo 'This is a bad command : del c:\*.* ';

// Q3:
// $var = 'PHP Tutorial';


// for ($i=0; $i < 5; $i++) { 
//     for ($j=0; $j <= $i; $j++) { 
//         echo "* ";
//     }
//     echo "\n";
// }

// for ($i=0; $i < 5; $i++) { 
//     for ($j=0; $j <= $i; $j++) { 
//         echo "* ";
//     }
//     echo "\n";
// }
// for ($i=0; $i < 5; $i++) { 
//     for ($j=5; $j > $i; $j--) { 
//         echo "* ";
//     }
//     echo "\n";
// }

// $num=1;
// for ($i=5; $i > 0; $i--) { 
//     $num*=$i;
// }
// echo $num;
// [
//     [
//         id => 1,
//         name => 'sdf'
//     ],
//     [ id => 2,
//     name => 'sdf'],
//     [ id => 3,
//     name => 'sdf']
// ]


// function('delete', 1)
$ceu = array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris", "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", "United Kingdom"=>"London", "Cyprus"=>"Nicosia", "Lithuania"=>"Vilnius", "Czech Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", "Latvia"=>"Riga", "Malta"=>"Valetta", "Austria" => "Vienna", "Poland"=>"Warsaw") ;
asort($ceu);

$x = array(1, 2, 3, 4, 5);

$json='{"Title": "The Cuckoos Calling",
    "Author": "Robert Galbraith",
    "Detail": {
    "Publisher": "Little Brown"
    }}';
$decodedJson=json_decode($json, true);
var_dump($decodedJson);
array_walk_recursive($decodedJson, function($value, $key){
    echo "$key: $value<br>";
});

$temp=[78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];
sort($temp);


require "practice_view.php";