<?php
session_start();
$_SESSION['users'] ?? $_SESSION['users'] = [];
$isDataValid = true;
$loginNameErr = $loginPasswordErr = '';
require "../server/validationFunctions.php";


if (isset($_POST['register'])) {
    $registrationErr = [
        'fnameErr' => validateTextData($_POST['fname'], $isDataValid),
        'unameErr' => validateUsername($_POST['uname'], $isDataValid),
        'emailErr' => validateEmail($_POST['email'], $isDataValid),
        'phoneErr' => validatePhoneNumber($_POST['phone'], $isDataValid),
        'passwordErr' => validatePasswordFormat($_POST['password'], $isDataValid),
        'cnfrmPasswordErr' => validateCnfrmPassword($_POST['confirmPassword'], $_POST['password'], $isDataValid),
    ];

    if ($isDataValid) {
        unset($_POST['confirmPassword'], $_POST['register']);
        $_SESSION['users'][$_POST['email']] = $_POST;
        // array_push($_SESSION['users'], $_POST);
        header('Location: ../client/login.php');
    }
    
}

if (isset($_POST['login'])) {
    if (validateLoginData($_POST['loginName'], $_POST['loginPassword'], $loginNameErr, $loginPasswordErr)) {
        $_SESSION['loginName'] = $_POST['loginName'];
        header("Location: ../client/dashboard.php");
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['loginName']);
    header("Location: ../client/login.php");
}
?>