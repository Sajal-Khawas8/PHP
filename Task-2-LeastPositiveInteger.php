<?php
// $arr = array(-1, -3, 1, 2, 3);
// sort($arr);

// $ans = array();
// function leastPositive($v1, $v2)
// {
//     global $ans;
//     if ($v2 - $v1 > 1 && $v1 > 0) {
//         array_push($ans, $v1 + 1);
//     }
//     return $v2;
// }
// array_reduce($arr, "leastPositive");
// if ((!in_array(1, $arr)) || ($arr[count($arr) - 1] <= 0)) {
//     echo 1;
// } elseif (count($ans)) {
//     echo current($ans);
// } else {
//     echo $arr[count($arr) - 1] + 1;
// }
// // print_r($ans);


$arr = array(-1, -2, -3, 1, 3);
sort($arr);
$allInts = range(1, end($arr) + 1);
$missingNumbers = array_diff($allInts, $arr);
function positiveInt($v)
{
    return $v > 0;
}

$ans = array_filter($missingNumbers, "positiveInt");
echo current($ans);

?>