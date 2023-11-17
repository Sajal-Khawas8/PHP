<?php

class User
{
    public function addUser($data)
    {
        $isDataValid = true;
        $validate = new ValidateData();
        $err = [
            'fnameErr' => $validate->validateTextData($data['name'], $isDataValid),
            'unameErr' => $validate->validateUsername($data['username'], $isDataValid),
            'genderErr' => $validate->validateGender($data['gender'] ?? null, $isDataValid),
            'emailErr' => $validate->validateEmail($data['email'], $isDataValid),
            'phoneErr' => $validate->validatePhoneNumber($data['phone'], $isDataValid),
            'passwordErr' => $validate->validatePasswordFormat($data['password'], $isDataValid),
            'cnfrmPasswordErr' => $validate->validateCnfrmPassword($data['confirmPassword'], $data['password'], $isDataValid),
            'pictureErr' => $validate->validatePictureFormat($_FILES['profilePicture'], $isDataValid)
        ];

        if ($isDataValid) {
            unset($data['confirmPassword'], $data['register']);
            $query = new DatabaseQuery();
            $query->add('users', $data);
            $file = new File($_FILES['profilePicture']);
            if ($file->fileExist) {
                $file->uploadFile($query->selectColumn('id', 'users', $data['email'], 'email'));
            }
            header('Location: ../client/login.php');
            exit;
        } else {
            return $err;
        }
    }

    public function updateUser($data)
    {
        $isDataValid = true;
        $validate = new ValidateData();
        $err = [
            'fnameErr' => $validate->validateEditedTextData($data['name'], $isDataValid),
            'unameErr' => $validate->validateEditedUsername($data['username'], $isDataValid, $data['id']),
            'genderErr' => '',
            # There will be no gender error because if user doesn't select gender then it will not be changed
            'emailErr' => $validate->validateEditedEmail($data['email'], $isDataValid, $data['id']),
            'phoneErr' => $validate->validateEditedPhoneNumber($data['phone'], $isDataValid, $data['id']),
            'oldPasswordErr' => $validate->validateOldPassword($data['oldPassword'], $isDataValid, $data['id']),
            'passwordErr' => $validate->validateNewPasswordFormat($data['password'], $isDataValid),
            # New password
            'pictureErr' => $validate->validatePictureFormat($_FILES['profilePicture'], $isDataValid)
        ];

        if ($isDataValid) {
            $id = $data['id'];
            unset($data['oldPassword'], $data['id']);
            $date = date("Y-m-d H:i:s");
            $updateStr = '';
            foreach ($data as $key => $value) {
                if (!empty($value)) {
                    $updateStr .= $key . " = '" . $value . "', ";
                }
            }
            $updateStr .= 'locked=true';
            $query = new DatabaseQuery();
            $query->update('users', $updateStr, $id);
            $file = new File($_FILES['profilePicture']);
            if ($file->fileExist) {
                $imgId = $query->selectColumn('img_id', 'user_img', $id, 'user_id');
                $file->uploadFile($id, $imgId);

            }
            unset($_SESSION['loginName']);
            header('Location: ../client/login.php');
            exit;
        } else {
            return $err;
        }
    }

    public function removeUser($id)
    {
        $query = new DatabaseQuery();
        $query->delete('users', $id);
        unset($_SESSION['loginName']);
        header("Location: ../client/index.php");
        exit;
    }
}