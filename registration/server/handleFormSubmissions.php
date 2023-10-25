<?php
session_start();
$_SESSION['users'] ?? $_SESSION['users'] = [];
$isDataValid = true;
$loginNameErr = $loginPasswordErr = '';
require "../server/dbConnection.php";
require "../server/validationFunctions.php";

// Handle Registration Form
if (isset($_POST['register'])) {
    $registrationErr = [
        'fnameErr' => validateTextData($_POST['fname'], $isDataValid),
        'unameErr' => validateUsername($_POST['uname'], $isDataValid),
        'genderErr' => validateGender($_POST['gender'] ?? null, $isDataValid),
        'emailErr' => validateEmail($_POST['email'], $isDataValid),
        'phoneErr' => validatePhoneNumber($_POST['phone'], $isDataValid),
        'passwordErr' => validatePasswordFormat($_POST['password'], $isDataValid),
        'cnfrmPasswordErr' => validateCnfrmPassword($_POST['confirmPassword'], $_POST['password'], $isDataValid),
    ];

    if ($isDataValid) {
        unset($_POST['confirmPassword'], $_POST['register']);
        $sql = "INSERT INTO `users` (`name`, `username`, `gender`, `email`, `phone`, `password`) VALUES ('{$_POST['fname']}', '{$_POST['uname']}', '{$_POST['gender']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}')";
        if ($conn->query($sql) === false) {
            die("Error creating user: " . $conn->error);
        }
        header('Location: ../client/login.php');
        exit;
    }

}

// Handle Login Form
if (isset($_POST['login'])) {
    if (validateLoginData($_POST['loginName'], $_POST['loginPassword'], $loginNameErr, $loginPasswordErr)) {
        $sql = "SELECT email FROM `users` WHERE email = '{$_POST['loginName']}' OR username = '{$_POST['loginName']}' OR phone = '{$_POST['loginName']}'";
        $result=$conn->query($sql);
        $_SESSION['loginName'] = $result->fetch_column();
        header("Location: ../client/dashboard.php");
        exit;
    }
}

// Handle Logout button
if (isset($_POST['logout'])) {
    unset($_SESSION['loginName']);
    header("Location: ../client/login.php");
    exit;
}

//Handle Lock Button
if (isset($_POST['lockUser'])) {
    $sql = "UPDATE `users` SET active = false WHERE id='{$_POST['id']}'";
    $conn->query($sql);
}

//Handle Unlock Button
if (isset($_POST['unlockUser'])) {
    $sql = "UPDATE `users` SET active = true WHERE id='{$_POST['id']}'";
    $conn->query($sql);
}

//Handle Edit Button
if (isset($_POST['editData'])) {
    $sql = "SELECT * FROM `users` WHERE id='{$_POST['id']}'";
    $result = $conn->query($sql);
    $data = $result->fetch_array(MYSQLI_ASSOC);
    header("Location: ../client/updateForm.php?name={$data['name']}&uname={$data['username']}&gender={$data['gender']}&email={$data['email']}&phone={$data['phone']}");
    exit;
}

//Handle Delete Button
if (isset($_POST['deleteUser'])) {
    $sql = "DELETE FROM `users` WHERE email='{$_SESSION['loginName']}' OR username='{$_SESSION['loginName']}' OR phone='{$_SESSION['loginName']}'";
    $conn->query($sql);
    unset($_SESSION['loginName']);
    header("Location: ../client/index.php");
    exit;
}

// Handle Update Form
if (isset($_POST['update'])) {
    $updationErr = [
        'fnameErr' => validateEditedTextData($_POST['name'], $isDataValid),
        'unameErr' => validateEditedUsername($_POST['username'], $isDataValid),
        'genderErr' => '', # There will be no gender error because if user doesn't select gender then it will not be changed
        'emailErr' => validateEditedEmail($_POST['email'], $isDataValid),
        'phoneErr' => validateEditedPhoneNumber($_POST['phone'], $isDataValid),
        'passwordErr' => validateEditedPasswordFormat($_POST['password'], $isDataValid),
        'cnfrmPasswordErr' => validateCnfrmPassword($_POST['confirmPassword'], $_POST['password'], $isDataValid),
    ];

    // if ($isDataValid) {
    //     unset($_POST['confirmPassword']);
    //     $updateStr = '';
    //     foreach ($_POST as $key => $value) {
    //         if (!empty($value)) {
    //             $updateStr.=$key . " = '" . $value . "', ";
    //         }
    //     }
    //     $updateStr=substr($updateStr, 0, -2);
    //     $sql = "UPDATE `users` SET $updateStr";
    //     $conn->query($sql);
    //     unset($_SESSION['loginName']);
    //     header('Location: ../client/login.php');
    //     exit;
    // }

}
?>