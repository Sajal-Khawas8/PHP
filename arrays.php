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
    $a=array('a', 'b', 'c');
    print_r(array_fill(2, 4, 'e'));
    echo "<br>";
    print_r(array_fill_keys($a, 'd'));
    ?>
</body>

</html>