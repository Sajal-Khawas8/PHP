<?php
session_start();
require "../server/validationFunctions.php";

$loginNameErr = $loginPasswordErr = '';
if (isset($_POST['login'])) {
    $loginNameErr = validateLoginName($_POST['loginName']);
    if ($loginNameErr===NULL) {
        $loginPasswordErr = validateLoginPassword($_POST['loginPassword']);
        if ($loginPasswordErr===NULL) {
            $_SESSION['loginName']=$_POST['loginName'];
            header("Location: ../client/dashboard.php");
        }
    }

}

?>