<?php

// require "../server/database.php";

class ValidateData
{
    use Connection;
    private function cleanData(&$data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    private function isEmpty($data, &$msg, $field)
    {
        if (empty($data)) {
            $msg = "*Please enter your $field";
            return TRUE;
        }
    }

    private function isInvalidMinLength($data, &$msg, $field)
    {
        if (strlen($data) < 3) {
            $msg = "*{$field} must contain more than 3 characters";
            return TRUE;
        }
    }

    private function isInvalidMaxLength($data, &$msg, $field)
    {
        if (strlen($data) > 15) {
            $msg = "*{$field} must contain less than 15 characters";
            return TRUE;
        }
    }

    private function isInvalidFormat($data, &$msg, $field)
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
                if (!preg_match("/^[a-zA-Z]+[0-9]+$/", $data)) {
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
                if (!preg_match("/^[0-9]{10}$/", $data)) {
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

    private function isRedundantData($data, &$msg, $field, $dataType, $userId = null)
    {
        $query = new DatabaseQuery();
        $id = $query->selectColumn('id', 'users', $data, $dataType);
        if ($id !== false && $id !== $userId) {
            $msg = "*This $field has already been taken";
            return TRUE;
        }
    }

    private function validatePassword($firstPassword, $secondPassword)
    {
        return ($firstPassword === $secondPassword);
    }

    public function validateTextData(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $data = ucwords($data);
        $errMsg = NULL;
        if ($this->isEmpty($data, $errMsg, 'Name') || $this->isInvalidMinLength($data, $errMsg, 'Name') || $this->isInvalidMaxLength($data, $errMsg, 'Name') || $this->isInvalidFormat($data, $errMsg, 'Name')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateUsername(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $data = strtolower($data);
        $errMsg = NULL;
        if ($this->isEmpty($data, $errMsg, 'Username') || $this->isInvalidMinLength($data, $errMsg, 'Username') || $this->isInvalidMaxLength($data, $errMsg, 'Username') || $this->isInvalidFormat($data, $errMsg, 'Username') || $this->isRedundantData($data, $errMsg, 'Username', 'username')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateGender($data, &$isDataValid)
    {
        if (!isset($data)) {
            $isDataValid = false;
            return "*Please select Gender";
        }
    }

    public function validateEmail(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $data = strtolower($data);
        $errMsg = NULL;
        if ($this->isInvalidFormat($data, $errMsg, 'Email Address') || $this->isRedundantData($data, $errMsg, 'Email Address', 'email')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validatePhoneNumber(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if ($this->isInvalidFormat($data, $errMsg, 'Phone Number') || $this->isRedundantData($data, $errMsg, 'Phone Number', 'phone')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validatePasswordFormat(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if ($this->isEmpty($data, $errMsg, 'Password') || $this->isInvalidFormat($data, $errMsg, 'Password')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateCnfrmPassword($cnfrmPassword, $password, &$isDataValid)
    {
        $this->cleanData($cnfrmPassword);
        if (empty($cnfrmPassword)) {
            $isDataValid = false;
            return "*Please Retype your Password";
        } elseif (!$this->validatePassword($cnfrmPassword, $password)) {
            $isDataValid = false;
            return "*Passwords do not match";
        }
    }

    public function validateEditedTextData(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $data = ucwords($data);
        $errMsg = NULL;
        if (!empty($data) && ($this->isInvalidMinLength($data, $errMsg, 'Name') || $this->isInvalidMaxLength($data, $errMsg, 'Name') || $this->isInvalidFormat($data, $errMsg, 'Name'))) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateEditedUsername(&$data, &$isDataValid, $id)
    {
        $this->cleanData($data);
        $data = strtolower($data);
        $errMsg = NULL;
        if (!empty($data) && ($this->isInvalidMinLength($data, $errMsg, 'Username') || $this->isInvalidMaxLength($data, $errMsg, 'Username') || $this->isInvalidFormat($data, $errMsg, 'Username') || $this->isRedundantData($data, $errMsg, 'Username', 'username', $id))) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateEditedEmail(&$data, &$isDataValid, $id)
    {
        $this->cleanData($data);
        $data = strtolower($data);
        $errMsg = NULL;
        if (!empty($data) && ($this->isInvalidFormat($data, $errMsg, 'Email Address') || $this->isRedundantData($data, $errMsg, 'Email Address', 'email', $id))) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateEditedPhoneNumber(&$data, &$isDataValid, $id)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if (!empty($data) && ($this->isInvalidFormat($data, $errMsg, 'Phone Number') || $this->isRedundantData($data, $errMsg, 'Phone Number', 'phone', $id))) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validateOldPassword(&$data, &$isDataValid, $id)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if ($this->isEmpty($data, $errMsg, 'Password') || $this->isInvalidFormat($data, $errMsg, 'Password')) {
            $isDataValid = false;
            return $errMsg;
        }
        $query = new DatabaseQuery();
        $accountPassword = $query->selectColumn('password', 'users', $id);
        if (!$accountPassword) {
            unset($_SESSION['loginName']);
            header("Location: ../client/index.php");
            exit;
        }
        if (!$this->validatePassword($accountPassword, $data)) {
            $isDataValid = false;
            return "Incorrect Password";
        }
    }

    public function validateNewPasswordFormat(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if (!empty($data) && $this->isInvalidFormat($data, $errMsg, 'Password')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    public function validatePictureFormat($uploadedFile, &$isDataValid)
    {
        if (!empty($uploadedFile['name']) && (!in_array(strtolower(pathinfo($uploadedFile['name'])['extension']), ['jpg', 'jpeg', 'png']))) {
            $isDataValid = false;
            return "*Please select jpg or png file";
        }
    }

    public function validateLoginDataAndSearchUser(&$loginName, &$loginNameErr = null, $loginPassword = null, &$loginPasswordErr = null)
    {
        $this->cleanData($loginName);
        $loginName = strtolower($loginName);
        $errMsg = NULL;
        if ($this->isEmpty($loginName, $loginNameErr, 'Username / Email Address or Phone Number')) {
            return FALSE;
        }

        if (preg_match("/^[0-9]*$/", $loginName)) {
            $dataType = 'phone';
        } elseif (filter_var($loginName, FILTER_VALIDATE_EMAIL)) {
            $dataType = 'email';
        } else {
            $dataType = 'username';
        }
        $query = new DatabaseQuery();
        $email = $query->selectColumn('email', 'users', $loginName, $dataType);
        if (!$email) {
            switch ($dataType) {
                case 'email':
                    $loginNameErr = "*Invalid Email Address";
                case 'phone':
                    $loginNameErr = "*Invalid Phone Number";
                case 'username':
                    $loginNameErr = "*Invalid Username";
            }
            return false;
        }

        if ($loginPassword === null) {
            return $email;
        }

        $this->cleanData($loginPassword);
        if ($this->isEmpty($loginPassword, $loginPasswordErr, 'Password')) {
            return FALSE;
        }
        $accountPassword = $query->selectColumn('password', 'users', $email, 'email');
        if (!$this->validatePassword($accountPassword, $loginPassword)) {
            $loginPasswordErr = "*Incorrect Password";
            return FALSE;
        }
        $loginName = $email;
        return TRUE;
    }
}