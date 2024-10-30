<?php
require_once '../core/Database.php';
require_once '../Models/peminjaman.php';

class PeminjamanController {
    private $peminjaman;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->peminjaman = new Peminjaman($db);
    }

    public function searchPeminjaman($query) {
        return $this->peminjaman->searchPeminjaman($query);
    }
    

    // Fetch all borrowings
    public function getAllPeminjaman() {
        return $this->peminjaman->getAllPeminjaman();
    }

    public function getPeminjamanToday() {
        return $this->peminjaman->getPeminjamanToday();
    }
    

    // Update borrowing status
    public function updateStatus($id, $status) {
        $tanggal_kembalian = null;
    
        if ($status == 'sudah dikembalikan') {
            $tanggal_kembalian = date('Y-m-d H:i:s'); // Mengisi tanggal dan jam pengembalian
        }
    
        return $this->peminjaman->updateStatus($id, $status, $tanggal_kembalian);
    }
    
    // Delete borrowing
    public function deletePeminjaman($id) {
        return $this->peminjaman->deletePeminjaman($id);
    }
    // Di dalam PeminjamanController.php


}
?>
