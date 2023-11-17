<?php
session_start();
$loginNameErr = $loginPasswordErr = '';
require "../server/bootstrap.php";

// Handle Registration Form
if (isset($_POST['register'])) {
    $user = new User();
    $registrationErr = $user->addUser($_POST);
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
    $validation = new ValidateData();
    if ($id = $validation->validateId($_POST['id'])) {
        $query = new DatabaseQuery();
        $query->update('users', 'locked=true', $id);
    } else {
        header("Location: ../client/dashboard.php");
        exit;
    }
}

//Handle Unlock Button
if (isset($_POST['unlockUser'])) {
    $validation = new ValidateData();
    if ($id = $validation->validateId($_POST['id'])) {
        $query = new DatabaseQuery();
        $query->update('users', 'locked=false', $id);
    } else {
        header("Location: ../client/dashboard.php");
        exit;
    }
}

//Handle Edit Button
if (isset($_POST['editData'])) {
    $validation = new ValidateData();
    if ($id = $validation->validateId($_POST['id'])) {
        $query = new DatabaseQuery();
        $data = $query->selectUserJoin('users', 'id', 'user_img', 'user_id', '*', $id);
        if (!$data) {
            unset($_SESSION['loginName']);
            header("Location: ../client/dashboard.php");
            exit;
        }
        header("Location: ../client/updateForm.php?id={$data['id']}&name={$data['name']}&uname={$data['username']}&gender={$data['gender']}&email={$data['email']}&phone={$data['phone']}&imageName={$data['display_name']}&image={$data['unique_name']}&imageUploadDate={$data['user_img_creation_date']}&imageChangeDate={$data['user_img_modification_date']}");
        exit;
    } else {
        header("Location: ../client/dashboard.php");
        exit;
    }
}

//Handle Delete Button
if (isset($_POST['deleteUser'])) {
    $validation = new ValidateData();
    if ($id = $validation->validateId($_POST['id'])) {
        $user = new User();
        $user->removeUser($id);
    } else {
        header("Location: ../client/dashboard.php");
        exit;
    }

}

// Handle Update Form
if (isset($_POST['update'])) {
    $user = new User();
    $updationErr = $user->updateUser($_POST);
}

// Handle Search Bar
if (isset($_POST['searchUser'])) {
    $isSearchErr = false;
    $searchErr;
    $validate = new ValidateData();
    $searchEmail = $validate->validateLoginDataAndSearchUser($_POST['searchData'], $searchErr);
    if ($searchErr !== null) {
        $isSearchErr = true;
    }
}
?>