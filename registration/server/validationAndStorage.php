<?php
session_start();
$_SESSION['users'] ?? $_SESSION['users']=[];
$isDataValid = true;
require "../server/validationFunctions.php";


if (isset($_POST['register'])) {
    $registrationErr = [
        'fnameErr' => validateTextData($_POST['fname'], $isDataValid),
        'unameErr' => validateUsername($_POST['uname'], $isDataValid),
        'emailErr' => validateEmail($_POST['email'], $isDataValid),
        'phoneErr' => validatePhoneNumber($_POST['phone'], $isDataValid),
        'passwordErr' => validatePassword($_POST['password'], $isDataValid),
        'cnfrmPasswordErr' => validateCnfrmPassword($_POST['confirmPassword'], $_POST['password'], $isDataValid),
    ];

    if ($isDataValid) {
        unset($_POST['confirmPassword'], $_POST['register']);
        $_SESSION['users'][$_POST['email']] = $_POST;
        // array_push($_SESSION['users'], $_POST);
        header('Location: ../client/login.php');
    }
    
}

?>