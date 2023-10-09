<?php

// Answer 1
// $arr = array(1, 2, 3, 4);
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


// Answer 2
// $arr = array(-1, -2, -3);
// sort($arr);
// $allInts = range(1, end($arr) + 1);
// $missingNumbers = array_diff($allInts, $arr);
// function positiveInt($v)
// {
//     return $v > 0;
// }

// $ans = array_filter($missingNumbers, "positiveInt");
// echo current($ans);

// Answer 3
$arr = array(2, 4, 3);
function positive($v)
{
    return $v > 0;
}

$positiveInts = array_filter($arr, "positive");
$positiveInts = array_values($positiveInts);
sort($positiveInts);
$l = count($positiveInts);
$result = null;
if ($l) {
    for ($i = 0; $i < $l; $i++) {
        if ($positiveInts[$i] > 1) {
            $result=1;
            break;
        }
        if (($i !== $l - 1) && ($positiveInts[$i + 1] - $positiveInts[$i] > 1)) {
            $result = $positiveInts[$i] + 1;
            break;
        }
    }
    if (!$result) {
        $result = $positiveInts[$l - 1] + 1;
    }


} else {
    $result = 1;
}

echo $result;

?>