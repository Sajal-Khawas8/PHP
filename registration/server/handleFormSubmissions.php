<?php
session_start();
$isDataValid = true;
$loginNameErr = $loginPasswordErr = '';
require "../server/dbConnection.php";
require "../server/validationFunctions.php";
date_default_timezone_set('Asia/Kolkata');

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
        'pictureErr' => validatePictureFormat($_FILES['profilePicture'], $isDataValid)
    ];

    if ($isDataValid) {
        unset($_POST['confirmPassword'], $_POST['register']);
        $sql = "INSERT INTO `users` (`name`, `username`, `gender`, `email`, `phone`, `password`) VALUES ('{$_POST['fname']}', '{$_POST['uname']}', '{$_POST['gender']}', '{$_POST['email']}', '{$_POST['phone']}', '{$_POST['password']}')";
        if (!$conn->query($sql)) {
            die("Error creating user: " . $conn->error);
        }
        if (!empty($_FILES['profilePicture']['name'])) {
            # code...
            $fileExtension = strtolower(pathinfo($_FILES['profilePicture']['name'])['extension']);
            $fileName = pathinfo($_FILES['profilePicture']['name'])['filename'] . "." . $fileExtension;
            $newFileName = uniqid() . "." . $fileExtension;
            if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], "../server/uploads/images/{$newFileName}")) {
                die("Error uploading file");
            }
            $sql = "SELECT id FROM `users` WHERE email = '{$_POST['email']}'";
            $userID = $conn->query($sql);
            if (!$userID) {
                die("Error searching userID: " . $conn->error);
            }
            $userID = $userID->fetch_column();
            $date = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `userImg` (`user_id`, `display_name`, `unique_name`, `creation_date`) VALUES ('{$userID}', '{$fileName}', '{$newFileName}', '{$date}')";
            if (!$conn->query($sql)) {
                die("Error uploading profile picture: " . $conn->error);
            }
        }
        header('Location: ../client/login.php');
        exit;
    }

}

// Handle Login Form
if (isset($_POST['login'])) {
    if (validateLoginData($_POST['loginName'], $_POST['loginPassword'], $loginNameErr, $loginPasswordErr)) {
        $sql = "SELECT email FROM `users` WHERE email = '{$_POST['loginName']}' OR username = '{$_POST['loginName']}' OR phone = '{$_POST['loginName']}'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Error in login: " . $conn->error);
        }
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
    if (!$conn->query($sql)) {
        die("Error locking user: " . $conn->error);
    }
}

//Handle Unlock Button
if (isset($_POST['unlockUser'])) {
    $sql = "UPDATE `users` SET active = true WHERE id='{$_POST['id']}'";
    if (!$conn->query($sql)) {
        die("Error unlocking user: " . $conn->error);
    }
}

//Handle Edit Button
if (isset($_POST['editData'])) {
    $sql = "SELECT * FROM `users` LEFT JOIN `userimg` ON `users`.`id` = `userimg`.`user_id` WHERE id='{$_POST['id']}'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error editing user: " . $conn->error);
    }
    $data = $result->fetch_array(MYSQLI_ASSOC);
    header("Location: ../client/updateForm.php?id={$data['id']}&name={$data['name']}&uname={$data['username']}&gender={$data['gender']}&email={$data['email']}&phone={$data['phone']}&imageName={$data['display_name']}&image={$data['unique_name']}");
    exit;
}

//Handle Delete Button
if (isset($_POST['deleteUser'])) {
    $sql = "DELETE FROM `users` WHERE email='{$_SESSION['loginName']}'";
    if (!$conn->query($sql)) {
        die("Error deleting user: " . $conn->error);
    }
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
        'oldPasswordErr' => validateOldPassword($_POST['oldPassword'], $isDataValid),
        'passwordErr' => validateNewPasswordFormat($_POST['password'], $isDataValid), # New password
        'pictureErr' => validatePictureFormat($_FILES['profilePicture'], $isDataValid)
    ];

    if ($isDataValid) {
        $id=$_POST['id'];
        unset($_POST['oldPassword'], $_POST['id']);
        $updateStr = '';
        foreach ($_POST as $key => $value) {
            if (!empty($value)) {
                $updateStr .= $key . " = '" . $value . "', ";
            }
        }
        $sql = "UPDATE `users` SET $updateStr active = true WHERE id='{$id}'";
        if (!$conn->query($sql)) {
            die("Error searching user $updateStr: " . $conn->error);
        }
        if (!empty($_FILES['profilePicture']['name'])) {
            $fileExtension = strtolower(pathinfo($_FILES['profilePicture']['name'])['extension']);
            $fileName = pathinfo($_FILES['profilePicture']['name'])['filename'] . "." . $fileExtension;
            $newFileName = uniqid() . "." . $fileExtension;
            $date=date("Y-m-d H:i:s");
            if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], "../server/uploads/images/{$newFileName}")) {
                die("Error uploading file");
            }
            $sql="SELECT * FROM `userImg` WHERE user_id = '{$id}'";
            $result=$conn->query($sql);
            if (!$result) {
                die("Error searching user image");
            }
            if ($result->num_rows > 0) {
                $sql = "UPDATE `userImg` SET display_name = '{$fileName}', unique_name = '{$newFileName}', modified_date = '{$date}' WHERE `user_id` = '{$id}'";
                if (!$conn->query($sql)) {
                    die("Error updating profile picture: " . $conn->error);
                }
            } else {
                $sql = "INSERT INTO `userImg` (`user_id`, `display_name`, `unique_name`, `creation_date`) VALUES ('{$id}', '{$fileName}', '{$newFileName}', '{$date}')";
                if (!$conn->query($sql)) {
                    die("Error updating profile picture: " . $conn->error);
                }
            }
        }
        unset($_SESSION['loginName']);
        header('Location: ../client/login.php');
        exit;
    }

}

// Handle Search Bar
if (isset($_POST['searchUser'])) {
    $isSearchErr = false;
    cleanData($_POST['searchData']);
    if (isEmpty($_POST['searchData'], $searchErr, 'Username / Email Address or Phone Number')) {
        $isSearchErr = true;
    } else {
        $searchEmail = searchUser($_POST['searchData']);
        if (stristr($searchEmail, "Invalid")) {
            $isSearchErr = true;
            $searchErr = $searchEmail;
        }
    }
}
?>