<?php
function cleanData(&$data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}

function validateTextData(&$data, &$isDataValid)
{
    cleanData($data);
    $data = ucwords($data);
    if (empty($data)) {
        $isDataValid = false;
        return "*Please enter your Name";
    } elseif (strlen($data) < 3) {
        $isDataValid = false;
        return "*Name must contain more than 3 characters";
    } elseif (strlen($data) > 20) {
        $isDataValid = false;
        return "*Name must contain less than 20 characters";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $data)) {
        $isDataValid = false;
        return "*Name must contain only letters and white spaces";
    }
}

function validateUsername(&$data, &$isDataValid)
{
    cleanData($data);
    $data = strtolower($data);
    if (empty($data)) {
        $isDataValid = false;
        return "*Please enter your Username";
    } elseif (strlen($data) < 3) {
        $isDataValid = false;
        return "*Username must contain more than 3 characters";
    } elseif (strlen($data) > 10) {
        $isDataValid = false;
        return "*Username must contain less than 10 characters";
    } elseif (!preg_match("/[a-zA-Z]+[0-9]+/", $data)) {
        $isDataValid = false;
        return "*Invalid Username. Username must be in the form of 'abc123'";
    } elseif (in_array($data, array_column($_SESSION['users'], 'uname'))) {
        $isDataValid = false;
        return "*This Username has already been taken";
    }
}

function validateEmail(&$data, &$isDataValid)
{
    cleanData($data);
    $data = strtolower($data);
    if (empty($data)) {
        $isDataValid = false;
        return "*Please enter your Email Address";
    } elseif (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        $isDataValid = false;
        return "*Invalid Email Address";
    }
    foreach ($_SESSION['users'] as $userDetails) {
        if ($userDetails['email'] === $data) {
            $isDataValid = false;
            return "*This Email has already been taken";
        }
    }
}

function validatePhoneNumber(&$data, &$isDataValid)
{
    cleanData($data);
    if (empty($data)) {
        $isDataValid = false;
        return "*Please enter your Phone Number";
    } elseif (!preg_match("/[0-9]{10}/", $data)) {
        $isDataValid = false;
        return "*Invalid Phone Number";
    } elseif (in_array($data, array_column($_SESSION['users'], 'phone'))) {
        $isDataValid = false;
        return "*This Phone Number has already been taken";
    }
}

function validatePassword(&$data, &$isDataValid)
{
    cleanData($data);
    if (empty($data)) {
        $isDataValid = false;
        return "*Please enter Password";
    } elseif (strlen($data) < 6) {
        $isDataValid = false;
        return "*Password must contain more than 6 characters";
    } elseif (strlen($data) > 16) {
        $isDataValid = false;
        return "*Password must contain less than 16 characters";
    } elseif (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()-_+])/", $data)) {
        $isDataValid = false;
        return "*Invalid Password. Password must contain one uppercase letter, one lowercase letter, one digit and one special character";
    }
}

function validateCnfrmPassword(&$cnfrmPassword, $password, &$isDataValid)
{
    cleanData($cnfrmPassword);
    if (empty($cnfrmPassword)) {
        $isDataValid = false;
        return "*Please Retype your Password";
    } elseif ($cnfrmPassword !== $password) {
        $isDataValid = false;
        return "*Passwords do not match";
    }
}

function validateLoginName(&$loginName, &$email)
{
    cleanData($loginName);
    $loginName = strtolower($loginName);
    if (empty($loginName)) {
        return "*Please enter your Username";
    }
    if (filter_var($loginName, FILTER_VALIDATE_EMAIL)) {
        $input='email';
    } elseif (preg_match("/^[0-9]*$/", $loginName)) {
        $input='phone';
    } else {
        $input='username';
    }

    switch ($input) {
        case 'email':
            foreach ($_SESSION['users'] as $userID => $userDetails) {
                if ($userDetails['email'] === $loginName) {
                    $email = $userID;
                    return;
                }
            }
            return "*Invalid Email Address";
        case 'phone':
            foreach ($_SESSION['users'] as $userID => $userDetails) {
                if ($userDetails['phone'] === $loginName) {
                    $email = $userID;
                    return;
                }
            }
            return "*Invalid Phone Number";
        case 'username':
            foreach ($_SESSION['users'] as $userID => $userDetails) {
                if ($userDetails['uname'] === $loginName) {
                    $email = $userID;
                    return;
                }
            }
            return "*Invalid Username";
    }
    
}

function validateLoginPassword($loginPassword, $id)
{
    cleanData($loginPassword);
    if (empty($loginPassword)) {
        return "*Please enter your Password";
    } elseif ($_SESSION['users'][$id]['password'] !== $loginPassword) {
        return "*Invalid Password";
    }
}

?>