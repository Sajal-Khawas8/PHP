<?php
    // Question 1
    $x = 0;
    if ($x == 1)
    if ($x >= 0)
    print "true";
    else
    print "false";

    /*Output: It will print nothing as $x is not equal to 1 so the nested if will not be executed
              And in absence of braces, the else will be associated with the inner if. 
              The above code can be rewritten as following:
    */
    $x = 0;
    if ($x == 1) {
        if ($x >= 0) {
            print "true";
        } else {
            print "false";
        }
        
    }


    // Question 2
    $x = 40;
    $y = 20;
    if($x == $y) {
    echo "1";
    } elseif ($x > $y) {
    echo "2";
    } else {
    echo "3";
    }

    //Output: 2 will be printed
    /* Reason: As 40 is not equal to 20 so the code inside if will not be executed.
               And 40 is greater than 20, so code inside elseif will be executed and therefore the output will be 2
    */


    // Question 3
    $color='red';
    switch ($color) {
        case "blue":
        echo "Hello";
        break;
        case "yellow":
        echo "W3docs";
        break;
        default:    //--->Added section that outputs "None" if $color is neither "blue" nor "yellow"
        echo "None";
    }
?>