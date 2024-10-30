<?php
include_once '../core/Database.php';
include_once '../Models/Buku.php';

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

// Cek apakah ada query pencarian
$searchQuery = isset($_POST['query']) ? $_POST['query'] : '';

// Query untuk mencari data buku
$stmt = $buku->search($searchQuery);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tampilkan data buku dalam bentuk HTML yang akan digunakan AJAX untuk menampilkan hasil pencarian
foreach ($rows as $i => $row) {
    echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
            <td class='py-2 px-4 text-left'>" . htmlspecialchars($i + 1) . "</td>
            <td class='py-2 px-4 text-left'>" . htmlspecialchars($row['kode_buku']) . "</td>
            <td class='py-2 px-4 text-left'>" . htmlspecialchars($row['judul_buku']) . "</td>
            <td class='py-2 px-4 text-left'>" . htmlspecialchars($row['kategori']) . "</td>
            <td class='py-2 px-4 text-left'>" . htmlspecialchars($row['penerbit']) . "</td>
            <td class='py-2 px-4 text-left'>" . htmlspecialchars($row['stok_buku']) . "</td>
            <td class='py-2 px-4 text-left'>
                <img src='../uploads/" . htmlspecialchars($row['cover']) . "' alt='Cover Buku' width='60'>
            </td>
            <td class='py-2 px-4 text-left'>
                <a href='updatebuku.php?id=" . htmlspecialchars($row['id_buku']) . "' class='text-blue-600'>Edit</a>
                <button onclick='confirmDelete(" . htmlspecialchars($row['id_buku']) . ")' class='text-red-700 ml-2'>Delete</button>
            </td>
          </tr>";
}
?>
