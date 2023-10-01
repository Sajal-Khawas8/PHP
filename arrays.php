<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>

<body>
    <?php
    // // array_change_key_case
    // $arr = array('name' => 'Sajal', 'age' => 20);
    // print_r($arr);
    // echo "<br>";
    // print_r(array_change_key_case($arr, CASE_UPPER));
    // echo "<br>";
    
    // //duplicate keys
    // $arr = array('name' => 'Sajal', 'age' => 20, 'Name' => 'Neeraj', 'AGE' => 21);
    // print_r($arr);
    // echo "<br>";
    // print_r(array_change_key_case($arr, CASE_UPPER));
    // echo "<br>";
    
    //array_chunk
    // $arr = array('a', 'b', 'c', 'd', 'e');
    // print_r(array_chunk($arr, 2));
    // echo "<br>";
    // print_r(array_chunk($arr, 2, true));
    // echo "<br>";
    // print_r(array_chunk($arr, 8));
    // echo "<br>";
    
    // array_column
    // $a = array(
    //     array(
    //         'id' => 5698,
    //         'first_name' => 'Peter',
    //         'last_name' => 'Griffin',
    //     ),
    //     array(
    //         'id' => 4767,
    //         'first_name' => 'Ben',
    //         'last_name' => 'Smith',
    //     ),
    //     array(
    //         'id' => 3809,
    //         'first_name' => 'Joe',
    //         'last_name' => 'Doe',
    //     )
    // );
    
    // $last_names = array_column($a, 'last_name');
    // print_r($last_names);
    // echo "<br>";
    // $last_names = array_column($a, 'last_name', 'id');
    // print_r($last_names);
    // echo "<br>";
    
    // array_combine
    // $a = array('name', 'age');
    // $b = array('sajal', 20);
    // $c=array_combine($a, $b);
    // print_r($c);
    // echo "<br>";
    
    // array_count_values
    // $a=array('a', 'b', 'e', 'd', 'a', 'b');
    // print_r(array_count_values($a));
    
    //array_diff
    // $a1 = array("a" => "red", "e" => "green", "c" => "blue", "b" => "yellow");
    // $a2 = array("c" => "blue", "a" => "red", "b" => "green");
    
    // $result = array_diff($a1, $a2);
    // print_r($result);
    // echo "<br>";
    // $result = array_diff_assoc($a1, $a2);
    // print_r($result);
    // echo "<br>";
    // $result = array_diff_key($a1, $a2);
    // print_r($result);
    // echo "<br>";
    
    //array_fill
    // $a=array('a', 'b', 'c');
    // print_r(array_fill(2, 4, 'e'));
    // echo "<br>";
    // print_r(array_fill_keys($a, 'd'));
    
    // array_filter
    
    // function filterArray($val, $key){
    //     if ($val%2!==0 && $key===2) {
    //         return 1;
    //     }
    // }
    
    // $arr=array(1, 2, 3, 4, 5);
    // $filteredArr=array_filter($arr, "filterArray", ARRAY_FILTER_USE_BOTH);
    // print_r($filteredArr);
    
    // Removing duplicate values from array
    // function unique($val, $key)
    // {
    //     return $key === array_search($val, array(1, 2, 3, 2, 1));
    // }
    
    // $a = array(1, 2, 3, 2, 1);
    // $uniqueArr = array_filter($a, 'unique', 1);
    // print_r($uniqueArr);
    
    // array_flip
    // $a1 = array("a" => "red", "b" => "green", "c" => "blue", "d" => "yellow", 'e' => 'green');
    // $result = array_flip($a1);
    // print_r($result);
    
    // array_intersect
    // $a1 = array("a" => "red", "b" => "green", "c" => "blue", "d" => "yellow");
    // $a2 = array("e" => "red", "b" => "green", "a" => "blue");
    
    // $result = array_intersect($a1, $a2);
    // print_r($result);
    // echo "<br>";
    // $result = array_intersect_assoc($a1, $a2);
    // print_r($result);
    // echo "<br>";
    // $result = array_intersect_key($a1, $a2);
    // print_r($result);
    // echo "<br>";
    
    // array_keys
    // $a = array("Volvo" => "1", "BMW" => "2", "Toyota" => 1);
    // print_r(array_keys($a, 1, true));
    
    // array_map
    // function myfunction($v)
    // {
    //     return ($v * $v);
    // }
    // function myfunction2($v1, $v2)
    // {
    //     return ($v1 + $v2);
    // }
    
    // $a1 = array(1, 2, 3, 4, 5);
    // $a2 = array(8, 4, 1, 2, 9);
    // print_r(array_map("myfunction", $a1, $a2));
    // echo "<br>";
    // print_r(array_map("myfunction2", $a1, $a2));
    
    // array_merge
    // $a1 = array("a" => "red", "b" => "green");
    // $a2 = array("c" => "blue", "b" => "yellow");
    // print_r(array_merge($a1, $a2));
    // echo "<br>";
    // print_r(array_merge_recursive($a1, $a2));
    // echo "<br>";
    
    // array_multisort
    // $a1 = array("a" => "red", "b" => "green");
    // $a2 = array("c" => "blue", "b" => "yellow");
    // array_multisort($a1, $a2);
    // print_r($a1);
    // echo "<br>";
    // print_r($a2);
    // echo "<br>";
    
    // array_pad()
    // $a = array("red", "green");
    // print_r(array_pad($a, 8, "blue"));
    
    // array_reduce()
    // function myfunction($v1, $v2)
    // {
    //     return $v1 . "-" . $v2;
    // }
    // $a = array("Dog", "Cat", "Horse");
    // print_r(array_reduce($a, "myfunction", 5));
    
    // function myfunction($v1, $v2)
    // {
    //     return $v1 + $v2;
    // }
    // $a = [10, 15, 20];
    // print_r(array_reduce($a, "myfunction"));
    
    // array_slice()
    // $a = array("red", "green", "blue", "yellow", "brown");
    // print_r(array_slice($a, 2));
    // echo "<br>";
    // print_r(array_slice($a, 2, 3));
    // echo "<br>";
    // print_r(array_slice($a, -2, 3));
    // echo "<br>";
    // print_r(array_slice($a, -2, 3, true));
    // echo "<br>";
    
    // array_splice()
    // $a1 = array("a" => "red", "b" => "green", "c" => "blue", "d" => "yellow");
    // $a2 = array("a" => "purple", "b" => "orange");
    // print_r(array_splice($a1, 0, 0, $a2));
    // echo "<br>";
    // print_r($a1);
    
    // compact()
    // $firstname = "Peter";
    // $lastname = "Griffin";
    // $age = "41";
    // $result = compact("firstname", "lastname", "age");
    // print_r($result);
    
    // $firstname = "Peter";
    // $lastname = "Griffin";
    // $age = "41";
    // $name = array("firstname", "lastname");
    // $result = compact($name, "location", "age");
    // print_r($result);

    // list()
    // $a=array("a", "b", "c");
    // list($a1, , $c1)=$a;
    // echo "$a1 $c1";

    // range()
    print_r(range('1', '5'));
    echo "<br>";
    print_r(range('1', '5', 2));
    echo "<br>";
    print_r(range(10, 5));
    echo "<br>";
    print_r(range(1.1, 5, 0.01));
    echo "<br>";
    ?>
</body>

</html>