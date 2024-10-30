<?php
date_default_timezone_set('Asia/Jakarta');
require_once '../Controller/peminjamancontroller.php';
$peminjamanController = new PeminjamanController();

// Mendapatkan data hari ini atau semua
$today = isset($_GET['filter']) && $_GET['filter'] == 'today';
$peminjamans = $today ? $peminjamanController->getPeminjamanToday() : $peminjamanController->getAllPeminjaman();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../css/output.css" rel="stylesheet" />
  <title>Halaman Siswa</title>
  <!-- Font Family -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>



<body class="scroll-smooth font-fontMain">
  <!-- Pembungkus Content Start -->
  <main class="w-full h-screen grid grid-cols-5 ">



<?php require '../Controller/sidebar.php';  ?>

    <div class="col-span-4 w-full">
    <!-- <div class="py-[13px] border-b-[2px] border-slate-300 px-4"> -->
    <div class="py-[13px] border-b-[2px] border-slate-300 px-4">
        <!-- search bar -->
        <div class="flex items-center justify-between ">
          <!-- Search Bar -->
              <div class="relative h-full w-[60%] pt-2">
                  <input type="text" id="search" placeholder="Search" class="w-full pl-4 pr-10 py-2 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                  <span class="absolute inset-y-0 right-3 flex items-center mt-2 me-2 text-gray-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </span>
              </div>

        
          <!-- User Profile and Notifications -->
          <div class="flex items-center space-x-4">
            <!-- User Profile -->
            <div class="flex items-center space-x-2">
              <img src="https://via.placeholder.com/40" alt="Profile Picture" class="w-8 h-8 rounded-full">
              <span class="font-medium text-gray-700">Rendi Fadillah</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
        
            <!-- Notification Icon -->
            <div class="text-gray-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2a6 6 0 00-6 6v3.586l-1.707 1.707a1 1 0 001.414 1.414L6 14h8l2.293 2.293a1 1 0 001.414-1.414L16 11.586V8a6 6 0 00-6-6zm2 14a2 2 0 11-4 0h4z" />
              </svg>
            </div>
          </div>
        </div>
        <main>

          <!-- Main Content End -->
        </main>
        <!-- Pembung  </div>
        <!-- Search Bar End -->
      </div>
    <div class=" mx-4">
        <!-- Judul -->

          <!-- Navtabs Section di atas judul -->
       
      
          <!-- Judul dan Button Section -->
          <div class="pt-5 mb-4">
              <h1 class="text-2xl font-bold">Daftar Peminjaman</h1>
          </div>
        <!-- Navtabs -->
     
        <div class="flex items-center mb-4">
            <a href="viewpeminjaman.php?filter=today" class="inline-flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 <?= $today ? 'bg-blue-500' : 'bg-gray-300 text-gray-400'; ?>">Hari Ini</a>
            <a href="viewpeminjaman.php" class="inline-flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ml-4 <?= !$today ? 'bg-blue-500' : 'bg-gray-300 text-gray-400'; ?>">Semua Hari</a>
        </div>


       <div class="overflow-x-auto mt-3 ml-4">
          
    <table class="min-w-full bg-white rounded-lg border-collapse table-auto text-xs">
        <thead> 
            <tr class="text-left bg-gray-200 font-semibold text-gray-600 uppercase">
                <th class="py-1 px-2">No</th>
                <th class="py-1 px-2">Nama Pengunjung</th>
                <th class="py-1 px-2">Kelas</th>
                <th class="py-1 px-2">No Kartu</th>
                <th class="py-1 px-2">Judul Buku</th>
                <th class="py-1 px-2">Kuantitas</th>
                <th class="py-1 px-2">Tanggal Peminjaman</th>
                <th class="py-1 px-2">Jam Peminjaman</th>
                <th class="py-1 px-2">Tanggal Pengembalian</th>
                <th class="py-1 px-2">Jam Pengembalian</th>
                <th class="py-1 px-2">Status</th>
                <th class="py-1 px-2">Aksi</th>
            </tr>
        </thead>
        <tbody id="search-results">
            <?php $no = 1; ?>
            <?php foreach ($peminjamans as $peminjaman) : ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-1 px-2"><?= $no++; ?></td>
                    <td class="py-1 px-2"><?= htmlspecialchars($peminjaman['nama_lengkap'] ?? ''); ?></td>
                    <td class="py-1 px-2"><?= htmlspecialchars($peminjaman['kelas'] ?? ''); ?></td>
                    <td class="py-1 px-2"><?= htmlspecialchars($peminjaman['no_kartu'] ?? ''); ?></td>
                    <td class="py-1 px-2"><?= htmlspecialchars($peminjaman['judul_buku'] ?? ''); ?></td>
                    <td class="py-1 px-2"><?= htmlspecialchars($peminjaman['kuantitas_buku'] ?? ''); ?></td>
                    <td class="py-1 px-2"><?= isset($peminjaman['tanggal_peminjaman']) ? date('Y-m-d', strtotime($peminjaman['tanggal_peminjaman'])) : '-'; ?></td>
                    <td class="py-1 px-2"><?= isset($peminjaman['tanggal_peminjaman']) ? date('H:i:s', strtotime($peminjaman['tanggal_peminjaman'])) : '-'; ?></td>
                    <td class="py-1 px-2"><?= isset($peminjaman['tanggal_kembalian']) ? date('Y-m-d', strtotime($peminjaman['tanggal_kembalian'])) : '-'; ?></td>
                    <td class="py-1 px-2"><?= isset($peminjaman['tanggal_kembalian']) ? date('H:i:s', strtotime($peminjaman['tanggal_kembalian'])) : '-'; ?></td>
                    <td class="py-1 px-2"><?= htmlspecialchars($peminjaman['status_peminjaman'] ?? ''); ?></td>
                    <td class="py-1 px-2">
                        <?php if ($peminjaman['status_peminjaman'] == 'proses') : ?>
                            <button onclick="updateStatus(<?= $peminjaman['id_peminjaman']; ?>, 'sedang dipinjam')" class="bg-green-500 hover:bg-green-700  text-white font-bold py-1 px-2 rounded">
                                Verif Peminjaman
                            </button>
                        <?php elseif ($peminjaman['status_peminjaman'] == 'sedang dipinjam') : ?>
                            <button onclick="updateStatus(<?= $peminjaman['id_peminjaman']; ?>, 'sudah dikembalikan')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Verif Pengembalian
                            </button>
                        <?php endif; ?>
                        <button onclick="confirmDelete(<?= $peminjaman['id_peminjaman']; ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>



    </div>
    <script>
        function updateStatus(id, status) {
    Swal.fire({
        title: 'Update Status Peminjaman',
        text: 'Apakah Anda yakin ingin mengubah status peminjaman ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update Status',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Update status dan tanggal kembalian otomatis
            window.location.href = 'editpeminjaman.php?id=' + id + '&status=' + status;
        }
    });
}


        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Peminjaman',
                text: 'Apakah Anda yakin ingin menghapus peminjaman ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete_peminjaman.php?id=' + id;
                }
            });
        }
    </script>
    <script>
document.getElementById('search').addEventListener('input', function() {
    const query = this.value;

    if (query.length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../Controller/search_peminjaman.php?query=' + query, true);
        xhr.onload = function() {
            if (this.status === 200) {
                document.getElementById('search-results').innerHTML = this.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById('search-results').innerHTML = '';
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</script>
</body>
</html>

