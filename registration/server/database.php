<?php

trait Connection
{
    private $conn;

    function __construct()
    {
        try {
            mysqli_report(MYSQLI_REPORT_OFF);
            // Establishing connection
            $config=require "../server/config.php";
            $this->conn = new mysqli($config['database']['hostname'], $config['database']['username'], $config['database']['password']);

            // Creating database
            $sql = "CREATE DATABASE IF NOT EXISTS UCodeSoftRegistration";
            $this->conn->query($sql);

            // Switching database
            $sql = "USE UCodeSoftRegistration";
            $this->conn->query($sql);

            // Creating users table
            $sql = "CREATE TABLE IF NOT EXISTS users (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(15) NOT NULL, username VARCHAR(15) NOT NULL UNIQUE, gender ENUM('Male', 'Female', 'Other') NOT NULL, email VARCHAR(50) NOT NULL UNIQUE, phone CHAR(10) NOT NULL UNIQUE, password VARCHAR(16) NOT NULL, locked BOOLEAN DEFAULT TRUE, creation_date DATETIME, modification_date DATETIME)";
            $this->conn->query($sql);

            // Creating userImg table
            $sql = "CREATE TABLE IF NOT EXISTS user_img (img_id INT PRIMARY KEY AUTO_INCREMENT, user_id int, display_name VARCHAR(50), unique_name VARCHAR(50), creation_date DATETIME, modification_date DATETIME DEFAULT NULL, FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE)";
            $this->conn->query($sql);
        } catch (Exception $ex) {
            die("Some error occured: " . $ex->getMessage());
        }
    }

    function __destruct()
    {
        $this->conn->close();
    }
}

interface CRUD
{
    public function add($table, $data);
    public function update($table, $updateStr, $searchId, $searchCriteria='id');
    public function delete($table, $criteria, $id);
    public function selectAllUsers($table);
    public function selectUser($table, $id);
    public function selectColumn($column, $table, $searchId, $searchCriteria);
    public function selectAllUsersJoin($table1, $table1MatchCol, $table2, $table2MatchCol);
    public function selectUserJoin($table1, $table1MatchCol, $table2, $table2MatchCol, $columnStr, $searchId, $searchCriteria = 'id');
}

class DatabaseQuery implements CRUD
{
    use Connection;
    public function add($table, $data)
    {
        $date = date("Y-m-d H:i:s");
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO $table ({$columns}, `creation_date`, `modification_date`) VALUES ('$values', '$date', '$date')";
        if (!$this->conn->query($sql)) {
            die("Error creating user: " . $this->conn->error);
        }
    }
    public function update($table, $updateStr, $searchId, $searchCriteria='id')
    {
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE $table SET $updateStr, modification_date = '$date' WHERE $searchCriteria='$searchId'";
        if (!$this->conn->query($sql)) {
            die("Error locking user: " . $this->conn->error);
        }
    }
    public function delete($table, $criteria, $id)
    {
        $sql = "DELETE FROM $table WHERE $criteria='$id'";
        if (!$this->conn->query($sql)) {
            die("Error deleting user: " . $this->conn->error);
        }
    }
    public function selectAllUsers($table)
    {
        $sql = "SELECT * FROM $table";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Some Error Occured: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function selectUser($table, $searchId, $searchCriteria = 'id')
    {
        $sql = "SELECT * FROM $table WHERE $searchCriteria = '$searchId'";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Some Error Occured: " . $this->conn->error);
        }
        return $result->fetch_assoc();
    }
    public function selectColumn($column, $table, $searchId, $searchCriteria = 'id')
    {
        $sql = "SELECT $column FROM $table WHERE $searchCriteria = '$searchId'";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Some Error Occured: " . $this->conn->error);
        }
        return $result->fetch_column();
    }

    public function selectAllUsersJoin($table1, $table1MatchCol, $table2, $table2MatchCol)
    {
        $sql = "SELECT *, $table1.creation_date, $table1.modification_date AS {$table1}_modification_date, $table2.modification_date AS {$table2}_modification_date FROM $table1 LEFT JOIN $table2 ON $table1.$table1MatchCol = $table2.$table2MatchCol ORDER BY $table1.$table1MatchCol";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error searching user: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selectUserJoin($table1, $table1MatchCol, $table2, $table2MatchCol, $columnStr, $searchId, $searchCriteria = 'id')
    {
        $sql = "SELECT $columnStr, $table1.creation_date AS {$table1}_creation_date, $table1.modification_date AS {$table1}_modification_date, $table2.creation_date AS {$table2}_creation_date, $table2.modification_date AS {$table2}_modification_date FROM $table1 LEFT JOIN $table2 ON $table1.$table1MatchCol = $table2.$table2MatchCol WHERE $searchCriteria='$searchId'";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error searching user: " . $this->conn->error);
        }
        return $result->fetch_assoc();
    }
}