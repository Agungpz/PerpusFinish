<?php
require_once '../core/database.php';
require_once '../Models/Kunjungan.php';

$database = new Database();
$db = $database->getConnection();
$kunjungan = new Kunjungan($db);

// Cek apakah ada query pencarian
if (isset($_POST['query'])) {
    $search = $_POST['query'];
    $query = "SELECT k.id_kunjungan, u.nama_lengkap, u.kelas, u.no_kartu, k.tanggal_kunjungan, k.keperluan 
              FROM kunjungan k 
              JOIN user u ON k.id_user = u.id_user 
              WHERE u.nama_lengkap LIKE :search 
                 OR u.kelas LIKE :search 
                 OR u.no_kartu LIKE :search 
                 OR k.keperluan LIKE :search";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $visit) {
        echo "<tr>
                <td class='py-2 px-4'>{$visit['nama_lengkap']}</td>
                <td class='py-2 px-4'>{$visit['kelas']}</td>
                <td class='py-2 px-4'>{$visit['no_kartu']}</td>
                <td class='py-2 px-4'>{$visit['tanggal_kunjungan']}</td>
                <td class='py-2 px-4'>{$visit['keperluan']}</td>
                <td class='py-2 px-4'>
                    <button onclick='confirmDelete({$visit['id_kunjungan']})' class='text-red-700 font-bold ml-2'>Hapus</button>
                </td>
              </tr>";
    }
}
?>
