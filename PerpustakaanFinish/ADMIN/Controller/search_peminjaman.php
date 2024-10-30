<?php
require_once '../Controller/peminjamancontroller.php';
$peminjamanController = new PeminjamanController();

$query = $_GET['query'] ?? '';
$peminjamans = $peminjamanController->searchPeminjaman($query);
$no = 1;

foreach ($peminjamans as $peminjaman) {
    echo '<tr class="border-b border-gray-200 hover:bg-gray-100">';
    echo '<td class="py-1 px-2">' . $no++ . '</td>';
    // echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['id_peminjaman']) . '</td>';
    echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['nama_lengkap']) . '</td>';
    echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['kelas']) . '</td>';
    echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['no_kartu']) . '</td>';
    echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['judul_buku']) . '</td>';
    echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['kuantitas_buku']) . '</td>';
    echo '<td class="py-1 px-2">' . (!empty($peminjaman['tanggal_peminjaman']) ? date('Y-m-d', strtotime($peminjaman['tanggal_peminjaman'])) : '-') . '</td>';
    echo '<td class="py-1 px-2">' . (!empty($peminjaman['tanggal_peminjaman']) ? date('H:i:s', strtotime($peminjaman['tanggal_peminjaman'])) : '-') . '</td>';
    echo '<td class="py-1 px-2">' . (!empty($peminjaman['tanggal_kembalian']) ? date('Y-m-d', strtotime($peminjaman['tanggal_kembalian'])) : '-') . '</td>';
    echo '<td class="py-1 px-2">' . (!empty($peminjaman['tanggal_kembalian']) ? date('H:i:s', strtotime($peminjaman['tanggal_kembalian'])) : '-') . '</td>';    
    echo '<td class="py-1 px-2">' . htmlspecialchars($peminjaman['status_peminjaman']) . '</td>';

    echo '<td class="py-1 px-2">';
    if ($peminjaman['status_peminjaman'] == 'proses') {
        echo '<button onclick="updateStatus(' . $peminjaman['id_peminjaman'] . ', \'sedang dipinjam\')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Verif Peminjaman</button>';
    } elseif ($peminjaman['status_peminjaman'] == 'sedang dipinjam') {
        echo '<button onclick="updateStatus(' . $peminjaman['id_peminjaman'] . ', \'sudah dikembalikan\')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Verif Pengembalian</button>';
    }
    echo '<button onclick="confirmDelete(' . $peminjaman['id_peminjaman'] . ')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">Hapus</button>';
    echo '</td>';

    echo '</tr>';
}
?>
