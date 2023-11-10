<?php

// require "../server/database.php";

class File
{
    private $file;
    public $fileExist;

    public function __construct($file)
    {
        $this->fileExist = !empty($file['name']);
        $this->file=$file;
    }

    public function uploadFile($userId, $imgId=false)
    {
        $fileExtension = strtolower(pathinfo($this->file['name'])['extension']);
        $newFileName = uniqid() . "." . $fileExtension;
        if (!move_uploaded_file($this->file['tmp_name'], "../server/uploads/images/{$newFileName}")) {
            die("Error uploading file");
        }
        $query=new DatabaseQuery();
        if ($imgId) {
            $query->update('user_img', "display_name = '{$this->file['name']}', unique_name = '$newFileName'", $imgId, 'img_id');
        } else {
            $fileData=[
                'user_id'=>$userId,
                'display_name'=>$this->file['name'],
                'unique_name'=>$newFileName
            ];
            $query->add('user_img', $fileData);
        }
    }
}