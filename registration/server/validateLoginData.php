<?php
session_start();
require "../server/validationFunctions.php";

$loginNameErr = $loginPasswordErr = $email = '';
if (isset($_POST['login'])) {
    $loginNameErr = validateLoginName($_POST['loginName'], $email);
    if ($loginNameErr===NULL) {
        $loginPasswordErr = validateLoginPassword($_POST['loginPassword'], $email);
        if ($loginPasswordErr===NULL) {
            $_SESSION['loginName']=$_POST['loginName'];
            header("Location: ../client/dashboard.php");
        }
    }

}

?>