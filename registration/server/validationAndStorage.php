<?php
session_start();
require "./functions.php";


if (isset($_POST['register'])) {
    $_SESSION['registrationErr']['fnameErr'] = validateTextData($_POST['fname']);
    $_SESSION['registrationErr']['unameErr'] = validateUsername($_POST['uname']);
    $_SESSION['registrationErr']['emailErr'] = validateEmail($_POST['email']);
    $_SESSION['registrationErr']['phoneErr'] = validatePhoneNumber($_POST['phone']);
    $_SESSION['registrationErr']['passwordErr'] = validatePassword($_POST['password']);
    $_SESSION['registrationErr']['cnfrmPasswordErr'] = validateCnfrmPassword($_POST['confirmPassword'], $_POST['password']);
    if (!$_SESSION['isDataValid']) {
        header('Location: ../client/');
    }
    
}

?>