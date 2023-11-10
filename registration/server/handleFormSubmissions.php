<?php
session_start();
$loginNameErr = $loginPasswordErr = '';
require "../server/bootstrap.php";

// Handle Registration Form
if (isset($_POST['register'])) {
    $user=new User();
    $registrationErr=$user->addUser($_POST);
}

// Handle Login Form
if (isset($_POST['login'])) {
    $validate = new ValidateData();
    if ($validate->validateLoginDataAndSearchUser($_POST['loginName'], $loginNameErr, $_POST['loginPassword'], $loginPasswordErr)) {
        $_SESSION['loginName'] = $_POST['loginName'];
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
    $query = new DatabaseQuery();
    $query->update('users', 'locked=true', $_SESSION['loginName'], 'email');
}

//Handle Unlock Button
if (isset($_POST['unlockUser'])) {
    $query = new DatabaseQuery();
    $query->update('users', 'locked=false', $_SESSION['loginName'], 'email');
}

//Handle Edit Button
if (isset($_POST['editData'])) {
    $query = new DatabaseQuery();
    $data = $query->selectUserJoin('users', 'id', 'user_img', 'user_id', '*', $_POST['id']);
    header("Location: ../client/updateForm.php?id={$data['id']}&name={$data['name']}&uname={$data['username']}&gender={$data['gender']}&email={$data['email']}&phone={$data['phone']}&imageName={$data['display_name']}&image={$data['unique_name']}&imageUploadDate={$data['user_img_creation_date']}&imageChangeDate={$data['user_img_modification_date']}");
    exit;
}

//Handle Delete Button
if (isset($_POST['deleteUser'])) {
    $user=new User();
    $user->removeUser();
}

// Handle Update Form
if (isset($_POST['update'])) {
    $user=new User();
    $updationErr = $user->updateUser($_POST);
}

// Handle Search Bar
if (isset($_POST['searchUser'])) {
    $isSearchErr = false;
    $searchErr;
    $validate=new ValidateData();
    $searchEmail = $validate->validateLoginDataAndSearchUser($_POST['searchData'], $searchErr);
    if ($searchErr !== null) {
        $isSearchErr=true;
    }
}
?>