<?php

class Database {
    protected $con;

    public function __construct() {
        $this->con = mysqli_connect("localhost", "root", "", "uts_sewamotor");

        if (!$this->con) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->con;
    }

    public function closeConnection() {
        mysqli_close($this->con);
    }
}

?>
