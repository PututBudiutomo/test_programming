<?php

class Database {
    private $host = "localhost";
    private $db_name = "kampus";
    private $db_user = "root";
    private $db_pass = "";
    public $koneksi;

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->db_user, $this->db_pass, $this->db_name);
        if (!$this->koneksi) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}

?>
