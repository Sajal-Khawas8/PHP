<?php
function cleanData(&$data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}

function isEmpty($data, &$msg, $field)
{
    if (empty($data)) {
        $msg = "*Please enter your $field";
        return TRUE;
    }
}

function isInvalidMinLength($data, &$msg, $field)
{
    if (strlen($data) < 3) {
        $msg = "*{$field} must contain more than 3 characters";
        return TRUE;
    }
}

function isInvalidMaxLength($data, &$msg, $field)
{
    if (strlen($data) > 15) {
        $msg = "*{$field} must contain less than 15 characters";
        return TRUE;
    }
}

function isInvalidFormat($data, &$msg, $field)
{
    $field = strtok($field, " ");
    switch ($field) {
        case 'Name':
        case 'name':
            if (!preg_match("/^[a-zA-Z ]*$/", $data)) {
                $msg = "*Name must contain only letters and white spaces";
                return TRUE;
            }
            break;
        case 'Username':
        case 'username':
            if (!preg_match("/[a-zA-Z]+[0-9]+/", $data)) {
                $msg = "*Invalid Username. Username must be in the form of 'abc123'";
                return TRUE;
            }
            break;
        case 'Email':
        case 'email':
            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                $msg = "*Invalid Email Address";
                return TRUE;
            }
            break;
        case 'Phone':
        case 'phone':
            if (!preg_match("/[0-9]{10}/", $data)) {
                $msg = "*Invalid Phone Number";
                return TRUE;
            }
            break;
        case 'Password':
        case 'password':
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()-_+]).{8,16}$/", $data)) {
                $msg = "*Your password must contain: <ul class='list-disc list-inside p-2.5'> <li>Uppercase letters (A-Z)</li><li>Lowercase letters (a-z)</li><li>Numbers (0-9)</li><li>Special Characters (!@#$%^&*()-_+)</li><li>Minimum 8 and Maximum 16 characters</li></ul>";
                return TRUE;
            }
            break;
    }

}

function isRedundantData($data, &$msg, $field, $dataType, $userId = null)
{
    global $conn;
    $sql = "SELECT id FROM `users` WHERE $dataType = '{$data}'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error searching user: " . $conn->error);
    }
    if ($result->num_rows > 0) {
        $id = $result->fetch_column();
        if ($id !== $userId) {
            $msg = "*This $field has already been taken";
            return TRUE;
        }

    }
}


function validateTextData(&$data, &$isDataValid)
{
    cleanData($data);
    $data = ucwords($data);
    $errMsg = NULL;
    if (isEmpty($data, $errMsg, 'Name') || isInvalidMinLength($data, $errMsg, 'Name') || isInvalidMaxLength($data, $errMsg, 'Name') || isInvalidFormat($data, $errMsg, 'Name')) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateUsername(&$data, &$isDataValid)
{
    cleanData($data);
    $data = strtolower($data);
    $errMsg = NULL;
    if (isEmpty($data, $errMsg, 'Username') || isInvalidMinLength($data, $errMsg, 'Username') || isInvalidMaxLength($data, $errMsg, 'Username') || isInvalidFormat($data, $errMsg, 'Username') || isRedundantData($data, $errMsg, 'Username', 'username')) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateGender($data, &$isDataValid)
{
    if (!isset($data)) {
        $isDataValid = false;
        return "*Please select Gender";
    }
}

function validateEmail(&$data, &$isDataValid)
{
    cleanData($data);
    $data = strtolower($data);
    $errMsg = NULL;
    if (isInvalidFormat($data, $errMsg, 'Email Address') || isRedundantData($data, $errMsg, 'Email Address', 'email')) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validatePhoneNumber(&$data, &$isDataValid)
{
    cleanData($data);
    $errMsg = NULL;
    if (isInvalidFormat($data, $errMsg, 'Phone Number') || isRedundantData($data, $errMsg, 'Phone Number', 'phone')) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validatePasswordFormat(&$data, &$isDataValid)
{
    cleanData($data);
    $errMsg = NULL;
    if (isEmpty($data, $errMsg, 'Password') || isInvalidFormat($data, $errMsg, 'Password')) {
        $isDataValid = false;
        return $errMsg;
    }
}
function validateEditedTextData(&$data, &$isDataValid)
{
    cleanData($data);
    $data = ucwords($data);
    $errMsg = NULL;
    if (!empty($data) && (isInvalidMinLength($data, $errMsg, 'Name') || isInvalidMaxLength($data, $errMsg, 'Name') || isInvalidFormat($data, $errMsg, 'Name'))) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateEditedUsername(&$data, &$isDataValid, $id)
{
    cleanData($data);
    $data = strtolower($data);
    $errMsg = NULL;
    if (!empty($data) && (isInvalidMinLength($data, $errMsg, 'Username') || isInvalidMaxLength($data, $errMsg, 'Username') || isInvalidFormat($data, $errMsg, 'Username') || isRedundantData($data, $errMsg, 'Username', 'username', $id))) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateEditedEmail(&$data, &$isDataValid, $id)
{
    cleanData($data);
    $data = strtolower($data);
    $errMsg = NULL;
    if (!empty($data) && (isInvalidFormat($data, $errMsg, 'Email Address') || isRedundantData($data, $errMsg, 'Email Address', 'email', $id))) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateEditedPhoneNumber(&$data, &$isDataValid, $id)
{
    cleanData($data);
    $errMsg = NULL;
    if (!empty($data) && (isInvalidFormat($data, $errMsg, 'Phone Number') || isRedundantData($data, $errMsg, 'Phone Number', 'phone', $id))) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateOldPassword(&$data, &$isDataValid, $id)
{
    cleanData($data);
    $errMsg = NULL;
    if (isEmpty($data, $errMsg, 'Password') || isInvalidFormat($data, $errMsg, 'Password')) {
        $isDataValid = false;
        return $errMsg;
    }
    global $conn;
    $sql = "SELECT password FROM `users` WHERE id=$id";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error searching user: " . $conn->error);
    }
    if (!validatePassword($result->fetch_column(), $data)) {
        $isDataValid = false;
        return "Incorrect Password";
    }
}

function validateNewPasswordFormat(&$data, &$isDataValid)
{
    cleanData($data);
    $errMsg = NULL;
    if (!empty($data) && isInvalidFormat($data, $errMsg, 'Password')) {
        $isDataValid = false;
        return $errMsg;
    }
}

function validateCnfrmPassword($cnfrmPassword, $password, &$isDataValid)
{
    cleanData($cnfrmPassword);
    // $errMsg = NULL;
    // if (isEmpty($cnfrmPassword, $errMsg, 'Password') || !validatePassword($password, $cnfrmPassword)) {
    //     $isDataValid = false;
    //     return $errMsg;
    // }
    if (empty($cnfrmPassword)) {
        $isDataValid = false;
        return "*Please Retype your Password";
    } elseif ($cnfrmPassword !== $password) {
        $isDataValid = false;
        return "*Passwords do not match";
    }
}

function validatePictureFormat($uploadedFile, $isDataValid)
{
    if (!empty($uploadedFile['name']) && (!in_array(strtolower(pathinfo($uploadedFile['name'])['extension']), ['jpg', 'png']))) {
        $isDataValid = false;
        return "*Please select jpg or png file";
    }
}

function searchUser($searchID)
{
    global $conn;
    if (preg_match("/^[0-9]*$/", $searchID)) {
        $dataType = 'phone';
    } elseif (filter_var($searchID, FILTER_VALIDATE_EMAIL)) {
        $dataType = 'email';
    } else {
        $dataType = 'username';
    }
    $sql = "SELECT `email` FROM `users` WHERE $dataType = '{$searchID}'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error searching user: " . $conn->error);
    }
    if ($result->num_rows > 0) {
        return $result->fetch_column();
    }
    switch ($dataType) {
        case 'email':
            return "*Invalid Email Address";
        case 'phone':
            return "*Invalid Phone Number";
        case 'username':
            return "*Invalid Username";
    }
}

function validatePassword($firstPassword, $secondPassword)
{
    return ($firstPassword === $secondPassword);
}

function validateLoginData(&$loginName, $loginPassword, &$loginNameErr, &$loginPasswordErr)
{
    cleanData($loginName);
    $loginName = strtolower($loginName);
    $errMsg = NULL;
    global $conn;
    if (isEmpty($loginName, $errMsg, 'Username / Email Address or Phone Number')) {
        $loginNameErr = $errMsg;
        return FALSE;
    }

    $email = searchUser($loginName);
    if (stristr($email, "Invalid")) {
        $loginNameErr = $email;
        return FALSE;
    }

    cleanData($loginPassword);
    if (isEmpty($loginPassword, $errMsg, 'Password')) {
        $loginPasswordErr = $errMsg;
        return FALSE;
    }
    $sql = "SELECT `password` FROM `users` WHERE email='{$email}'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error searching password: " . $conn->error);
    }
    if (!validatePassword($result->fetch_column(), $loginPassword)) {
        $loginPasswordErr = "*Incorrect Password";
        return FALSE;
    }
    return TRUE;
}

?>