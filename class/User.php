<?php

require_once 'Database.php';

class User {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function signUp($username, $email, $password, $nama_lengkap, $alamat, $nomor_telepon, $role) {
        $conn = $this->db->getConnection();
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        $nama_lengkap = mysqli_real_escape_string($conn, $nama_lengkap);
        $alamat = mysqli_real_escape_string($conn, $alamat);
        $nomor_telepon = mysqli_real_escape_string($conn, $nomor_telepon);
        $role = mysqli_real_escape_string($conn, $role);

        // Encrypt password before storing in database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password, nama_lengkap, alamat, nomor_telepon, role) VALUES ('$username', '$email', '$hashed_password', '$nama_lengkap', '$alamat', '$nomor_telepon', '$role')";
        $result = mysqli_query($conn, $query);

        $this->db->closeConnection();
        return $result;
    }

    public function loginUser($username, $password) {
        $conn = $this->db->getConnection();
        $username = mysqli_real_escape_string($conn, $username);

        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                header('Location: index.php');
                exit();
            } else {
                echo "<script>alert('Login gagal. Username atau password salah.'); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Login gagal. Username atau password salah.'); window.location.href = 'login.php';</script>";
        }

        $this->db->closeConnection();
    }
    public function getUserHistory($user_id) {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM Rentals WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }

        $stmt->close();
        $this->db->closeConnection();
        return $history;
    }
}

?>
