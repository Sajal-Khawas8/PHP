<?php

/**
 * This class is responsible for sanitizing and validating the input data
 * It contains all the methods for validating the input data
 * It also contains a method 'validateLoginDataAndSearchUser' which searches a user and returns the email for search utility
 */
class ValidateData
{
    /**
     * Uses the Connection trait from 'database.php' file which performs following functions:
     * 1. Establishes connection with the database (through constructor)
     * 2. Closes the connection after opertion (through destructor)
     */
    use Connection;

    /**
     * Sanitizes the input data.
     * It removes the white spaces, slashes and removes special characters
     * @param string $data The input data from the form 
     * @return void
     */
    private function cleanData(&$data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    /**
     * Checks if the input data is empty or not and sets the error message.
     * 
     * @param string $data The input data that is to be checked
     * @param string $msg The variable to contain the error message if data is empty
     * @param string $field The type of input field which is to be checked
     * @return bool Returns True if the data is empty, false otherwise
     */
    private function isEmpty($data, &$msg, $field)
    {
        if (empty($data)) {
            $msg = "*Please enter your $field";
            return TRUE;
        }
    }

    /**
     * Checks if the input data contains atleast 3 characters or not
     * 
     * @param string $data The input data that is to be checked
     * @param string $msg The variable to contain the error message if data does not contain atleast 3 characters
     * @param string $field The type of input field which is to be checked
     * @return bool Returns True if the data does not contain atleast 3 characters, false otherwise
     */
    private function isInvalidMinLength($data, &$msg, $field)
    {
        if (strlen($data) < 3) {
            $msg = "*{$field} must contain more than 3 characters";
            return TRUE;
        }
    }

    /**
     * Checks if the input data contains more than 15 characters or not
     * 
     * @param string $data The input data that is to be checked
     * @param string $msg The variable to contain the error message if data contains more than 15 characters
     * @param string $field The type of input field which is to be checked
     * @return bool Returns True if the data contains more than 15 characters, false otherwise
     */
    private function isInvalidMaxLength($data, &$msg, $field)
    {
        if (strlen($data) > 15) {
            $msg = "*{$field} must contain less than 15 characters";
            return TRUE;
        }
    }

    /**
     * Checks if the format of input data is valid or not
     * 
     * @param string $data The input data that is to be checked
     * @param string $msg The variable to contain the error message if data is not in valid form
     * @param string $field The type of input field which is to be checked
     * @return bool Returns True if the data is not in valid form, false otherwise
     */
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

    /**
     * Checks if the input data is already present in the database or not
     * 
     * @param string $data The input data that is to be checked
     * @param string $msg The variable to contain the error message if data is already present in the database
     * @param string $field The type of input field which is to be checked
     * @return bool Returns True if the data is already present in the database, false otherwise
     */
    private function isRedundantData($data, &$msg, $field, $dataType, $userId = null)
    {
        $query = new DatabaseQuery();
        $id = $query->selectColumn('id', 'users', $data, $dataType);
        if ($id !== false && $id !== $userId) {
            $msg = "*This $field has already been taken";
            return TRUE;
        }
    }

    /**
     * Checks if the two passwords are same or not
     * 
     * @param string $firstPassword First password for comparison
     * @param string $$secondPassword Second password for comparison
     * @return bool Returns True if the passwords match, false otherwise
     */
    private function validatePassword($firstPassword, $secondPassword)
    {
        return ($firstPassword === $secondPassword);
    }

    /**
     * santizes and Checks if the input text data is valid or not
     * It checks for empty value, minimum length, maximum length and format of data
     * 
     * @param string $data The input data that is to be checked
     * @param bool $isDataValid The variable to track if the data is valid or not
     * @return string|null Returns the error message if the data is not valid, or null otherwise
     */
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

    /**
     * Sanitizes and Checks if the username is valid or not
     * It checks for empty value, minimum length, maximum length, format and redundancy of username
     * It also converts the username to lowercase
     * 
     * @param string $data The input username that is to be checked
     * @param bool $isDataValid The variable to track if the username is valid or not
     * @return string|null Returns the error message if the username is not valid, or null otherwise
     */
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

    /**
     * Checks if the user has selected gender or not
     * 
     * @param string|null $data The input gender that user selected or null if user has not selected any option
     * @param bool $isDataValid The variable to track if user has selected gender or not
     * @return string|null Returns the error message if the user has not selected gender, or null otherwise
     */
    public function validateGender($data, &$isDataValid)
    {
        if (!isset($data)) {
            $isDataValid = false;
            return "*Please select Gender";
        }
    }

    /**
     * Sanitizes and Checks if the email is valid or not
     * It checks for format and redundancy of email
     * It also converts the email to lowercase
     * 
     * @param string $data The input email that is to be checked
     * @param bool $isDataValid The variable to track if the email is valid or not
     * @return string|null Returns the error message if the email is not valid, or null otherwise
     */
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

    /**
     * Checks if the phone number is valid or not
     * It checks for format and redundancy of phone number
     * 
     * @param string $data The input phone number that is to be checked
     * @param bool $isDataValid The variable to track if the phone number is valid or not
     * @return string|null Returns the error message if the phone number is not valid, or null otherwise
     */
    public function validatePhoneNumber(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if ($this->isInvalidFormat($data, $errMsg, 'Phone Number') || $this->isRedundantData($data, $errMsg, 'Phone Number', 'phone')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    /**
     * Checks if the password is in valid format or not
     * It checks for empty value and format of password
     * 
     * @param string $data The input password that is to be checked
     * @param bool $isDataValid The variable to track if the password is in valid format or not
     * @return string|null Returns the error message if the password is not in valid format, or null otherwise
     */
    public function validatePasswordFormat(&$data, &$isDataValid)
    {
        $this->cleanData($data);
        $errMsg = NULL;
        if ($this->isEmpty($data, $errMsg, 'Password') || $this->isInvalidFormat($data, $errMsg, 'Password')) {
            $isDataValid = false;
            return $errMsg;
        }
    }

    /**
     * Checks if the confirm password is valid or not
     * It checks if the field is empty and if the confirm password matches with the actual password
     * 
     * @param string $data The input confirm password that is to be checked
     * @param bool $isDataValid The variable to track if the confirm password is valid or not
     * @return string|null Returns the error message if the confirm pasword is not valid, or null otherwise
     */
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

    /**
     * valifate
     * frscri[yop]
     * @param $loginName string || NUll
     * @return mixed
     * 
     **/

    public function validateLoginDataAndSearchUser(&$loginName, &$loginNameErr = null, $loginPassword = null, &$loginPasswordErr = null)    //false|email
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

    public function validateId($id)
    {
        $config = require "../server/config.php";
        $id = openssl_decrypt($id, $config['openssl']['algo'], $config['openssl']['pass'], 0, $config['openssl']['iv']);
        if (!$id) {
            return false;
        } else {
            return $id;
        }
    }
}