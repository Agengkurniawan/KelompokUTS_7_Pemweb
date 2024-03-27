<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABSE', 'tugas_pemweb');

class Database{
    
    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABSE;

    public $link;
    public $error;

    public function __construct()
    {
        $this->dbConnect();
    }

    public function dbConnect(){
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->link) {
            $this->error = "Gagal Menghubungkan Database";
            return false;
        }
    }

    public function read($query){
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }else {
            return false;
        }
    }

    public function insert($query){
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if ($result) {
            return $result;
        }else {
            return false;
        }
    }

    public function update($query){
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if ($result) {
            return $result;
        }else {
            return false;
        }
    }

    public function delete($query){
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if ($result) {
            return $result;
        }else {
            return false;
        }
    }

}

?>