<?php
function cleanData(&$data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}

function validateTextData(&$data)
{
    cleanData($data);
    if (empty($data)) {
        $_SESSION['isDataValid']= false;
        return "*Please enter your Name";
    } elseif (strlen($data) < 3) {
        $_SESSION['isDataValid'] = false;
        return "*Name must contain more than 3 characters";
    } elseif (strlen($data) > 20) {
        $_SESSION['isDataValid'] = false;
        return "*Name must contain less than 20 characters";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $data)) {
        $_SESSION['isDataValid'] = false;
        return "*Name must contain only letters and white spaces";
    }
}

function validateUsername(&$data)
{
    cleanData($data);
    if (empty($data)) {
        $_SESSION['isDataValid']= false;
        return "*Please enter your Username";
    } elseif (strlen($data) < 3) {
        $_SESSION['isDataValid'] = false;
        return "*Username must contain more than 3 characters";
    } elseif (strlen($data) > 10) {
        $_SESSION['isDataValid'] = false;
        return "*Username must contain less than 10 characters";
    } elseif (!preg_match("/[a-zA-Z]+[0-9]+/", $data)) {
        $_SESSION['isDataValid'] = false;
        return "*Invalid Username. Username must be in the form of 'abc123'";
    }
}

function validateEmail(&$data)
{
    cleanData($data);
    if (empty($data)) {
        $_SESSION['isDataValid'] = false;
        return "*Please enter your Email Address";
    } elseif (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['isDataValid'] = false;
        return "*Invalid Email Address";
    }
}

function validatePhoneNumber(&$data)
{
    cleanData($data);
    if (empty($data)) {
        $_SESSION['isDataValid'] = false;
        return "*Please enter your Phone Number";
    } elseif (!preg_match("/[0-9]{10}/", $data)) {
        $_SESSION['isDataValid'] = false;
        return "*Invalid Phone Number";
    }
}

function validatePassword(&$data)
{
    cleanData($data);
    if (empty($data)) {
        $_SESSION['isDataValid']= false;
        return "*Please enter Password";
    } elseif (strlen($data) < 6) {
        $_SESSION['isDataValid'] = false;
        return "*Password must contain more than 6 characters";
    } elseif (strlen($data) > 16) {
        $_SESSION['isDataValid'] = false;
        return "*Password must contain less than 16 characters";
    } elseif (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()-_+])/", $data)) {
        $_SESSION['isDataValid'] = false;
        return "*Invalid Password. Password must contain one uppercase letter, one lowercase letter, one digit and one special character";
    }
}

function validateCnfrmPassword(&$cnfrmPassword, $password)
{
    $cnfrmPassword = trim($cnfrmPassword);
    if (empty($cnfrmPassword)) {
        $_SESSION['isDataValid']= false;
        return "*Please Retype your Password";
    } elseif ($cnfrmPassword !== $password) {
        $_SESSION['isDataValid'] = false;
        return "*Passwords do not match";
    }
}

?>