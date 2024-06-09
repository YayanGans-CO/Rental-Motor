<?php

require_once 'Database.php';

class Pendapatan {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTotalPendapatanBulanan() {
        $conn = $this->db->getConnection();
        $query = "
            SELECT SUM(total_biaya) AS total_pendapatan
            FROM Rentals
            WHERE MONTH(waktu_kembali) = MONTH(CURDATE())
            AND YEAR(waktu_kembali) = YEAR(CURDATE())
            AND status_pembayaran = 'berhasil'
        ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total_pendapatan = $row['total_pendapatan'] ? $row['total_pendapatan'] : 0;

        $this->db->closeConnection();
        return $total_pendapatan;
    }

    public function getTotalPendapatanTahunan() {
        $conn = $this->db->getConnection();
        $query = "
            SELECT SUM(total_biaya) AS total_pendapatan
            FROM Rentals
            WHERE YEAR(waktu_kembali) = YEAR(CURDATE())
            AND status_pembayaran = 'berhasil'
        ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total_pendapatan = $row['total_pendapatan'] ? $row['total_pendapatan'] : 0;

        $this->db->closeConnection();
        return $total_pendapatan;
    }

    public function getPersentasePembayaranSukses() {
        $conn = $this->db->getConnection();
        
        // Total pembayaran
        $query_total = "SELECT COUNT(*) AS total FROM Rentals";
        $result_total = mysqli_query($conn, $query_total);
        $row_total = mysqli_fetch_assoc($result_total);
        $total = $row_total['total'] ? $row_total['total'] : 0;

        // Pembayaran sukses
        $query_sukses = "SELECT COUNT(*) AS sukses FROM Rentals WHERE status_pembayaran = 'berhasil'";
        $result_sukses = mysqli_query($conn, $query_sukses);
        $row_sukses = mysqli_fetch_assoc($result_sukses);
        $sukses = $row_sukses['sukses'] ? $row_sukses['sukses'] : 0;

        $this->db->closeConnection();

        // Hitung persentase
        $persentase = $total > 0 ? ($sukses / $total) * 100 : 0;
        return $persentase;
    }
}

?>
