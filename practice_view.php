<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $var; ?></title>
</head>
<body>
    <h3><?= $var; ?></h3>
    <a href="<?= $var; ?>"><?= $var; ?></a>

    <ul>
        <?php foreach ($arr as $value) :?>
            <li><?= $value ?></li>
        <?php endforeach; ?>
    </ul>

    <table border="2px" cellpadding="3px" cellspacing="0">
        <?php for($i=1; $i<=10; $i++) :?>
            <tr>
                <?php for($j=1; $j<=10; $j++) :?>
                    <td><?= "$j * $i = " . $j*$i; ?> </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

    <div style="display:inline-block; margin:auto; border:4px solid black; background-color:gray" class=" border-2 border-gray-400">
        <?php for($i=0; $i<8; $i++) :?>
            <div>
                <?php for($j=0;$j<8;$j++) :?>
                    <div style="display:inline-block; height:64px; width: 64px; background-color:<?php echo ($i%2 === 0 && $j%2 !==0) || ($i%2 !== 0 && $j%2 ===0) ?  "black" : "white"; ?>" class=" h-5 w-5 bg-<?php echo ($i%2 !== 0 && $j%2 ===0) ?  "black" : "white"; ?>" ></div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>
<br>
    <?php foreach($ceu as $country=>$capital) :?>
        The capital of <strong><?= $country; ?></strong> is: <?= $capital . "<br>"; ?>
    <?php endforeach; ?>

    <?php 
        $pass=require "config.php";
        echo "password: ".$pass['pass'];

        echo "<br>Average Temperature: " . array_sum($temp)/count($temp);
        echo "<br>5 Lowest Temperature: ";
        for ($i=0; $i < 5; $i++) { 
            echo $temp[$i] . ", ";
        }
        echo "<br>5 Lowest Temperature: ";
        rsort($temp);
        for ($i=0; $i < 5; $i++) { 
            echo $temp[$i] . ", ";
        }
        echo "<br>";
        
        $multiplesFour=range(200, 250);
        $multiplesFour=array_filter($multiplesFour, function($n){
            return $n%4===0;
        });
        print_r($multiplesFour);
        echo "<br>";

        $strArr=["abcd","abc","de","hjjj","g","wer"];
        $strlengths=array_map(function($s){
            return strlen($s);
        }, $strArr);
        print_r($strlengths);
        echo "<br>Max length: " . max($strlengths);
        echo "<br>Min length: " . min($strlengths);
        echo "<br>";
        $randArr=range(11, 20);
        shuffle($randArr);
        print_r($randArr);

        $minInt=[4, 2, 0, 8, 7, 0, 4, 2];
        $minInt=array_diff($minInt, array(0));
        echo "<br>Min Int: " . min($minInt);
        echo "<br>";
        print_r(array ( "First", 5 => "Second", "Third"));
        echo "<br>";
        $color = array ( "color" => array ( "a" => "Red", "b" => "Green", "c" => "White"),
        "numbers" => array ( 1, 2, 3, 4, 5, 6 ),
        "holes" => array ( "First", 5 => "Second", "Third"));
        echo $color['holes'][5];
        echo $color['color']['a'];

        echo "<br>";
        $chars=array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9), array('!', '@', '#', '$', '%', '^', '&', '*', '-', '_'));
        // print_r($chars);
        $passwordKeys=array_rand($chars, 10);
        $password=array_map(function($k){
            global $chars;
            return $chars[$k];
        }, $passwordKeys);
        shuffle($password);
        echo "Password: ".implode('', $password);


        echo "<br>";
        $first_array = array('c1' => 'Red', 'c2' => 'Green', 'c3' => 'White', 'c4' => 'Black'); 
        $second_array = array('c2', 'c4');
        print_r(array_intersect_key($first_array, array_flip($second_array)));
    ?>


</body>
</html>