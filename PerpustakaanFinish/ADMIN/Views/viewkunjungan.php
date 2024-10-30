<?php
require_once '../Models/Kunjungan.php';

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Initialize the Kunjungan class
$kunjungan = new Kunjungan($db);

// Check if it's an AJAX request for live search

// Check if the delete button is clicked
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if ($kunjungan->deleteVisit($delete_id)) {
        echo "<script>Swal.fire('Berhasil', 'Data berhasil dihapus!', 'success');</script>";
    } else {
        echo "<script>Swal.fire('Gagal', 'Gagal menghapus data!', 'error');</script>";
    }
}

// Get all visit data
$visits = $kunjungan->getAllVisits();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../css/output.css" rel="stylesheet" />
  <title>Halaman Kunjungan</title>
  <!-- Font Family -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
          <div class="relative h-full w-[60%] pt-2 ">
          <input type="text" id="searchInput" placeholder="Search" class="w-full pl-4 pr-10 py-2 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">

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
              <h1 class="text-2xl font-bold">Daftar Kunjungan</h1>
          </div>
      
          <!-- Button and Dropdown Section -->
          <!-- <div class="flex justify-between items-center mb-4">
              <button type="button" class="inline-flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><a href="create.php">Tambah</a></button>
      
              <!-- Dropdown Button -->
              
          
      </div>
        
      <div class="overflow-x-auto ml-4 mt-6" >
    <table class="min-w-full bg-white shadow-md rounded-lg border-collapse table-auto">
        <thead>
            <tr class="text-left bg-gray-200 font-bold text-gray-600 uppercase text-sm">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Nama Pengunjung</th>
                <th class="py-2 px-4">Kelas</th>
                <th class="py-2 px-4">No Kartu</th>
                <th class="py-2 px-4">Tanggal Kunjungan</th>
                <th class="py-2 px-4">Keperluan</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody id="searchResults">
            <?php
            $no = 1;
            foreach ($visits as $visit) : ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-4 text-left whitespace-nowrap"><?= $no++; ?></td>
                    <td class="py-2 px-4 text-left"><?= htmlspecialchars($visit['nama_lengkap']); ?></td>
                    <td class="py-2 px-4 text-left"><?= htmlspecialchars($visit['kelas']); ?></td>
                    <td class="py-2 px-4 text-left"><?= htmlspecialchars($visit['no_kartu']); ?></td>
                    <td class="py-2 px-4 text-left"><?= htmlspecialchars($visit['tanggal_kunjungan']); ?></td>
                    <td class="py-2 px-4 text-left"><?= htmlspecialchars($visit['keperluan']); ?></td>
                    <td class="py-2 px-4 text-left">
                        <button onclick="confirmDelete(<?= $visit['id_kunjungan'] ?>)" class="text-red-700 font-bold ml-2">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    </div>

    <!-- SweetAlert Script -->
    <script>
        function confirmDelete(kunjunganId) {
            Swal.fire({
                title: 'Hapus Data Kunjungan',
                text: "Data yang dipilih akan dihapus secara permanen, yakin ingin menghapus data tersebut?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak, Terima Kasih'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?delete_id=' + kunjunganId;
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var query = $(this).val();
            $.ajax({
                url: 'search_kunjungan.php',
                method: 'POST',
                data: {query: query},
                success: function(response) {
                    $('#searchResults').html(response);
                }
            });
        });
    });
</script>


</main>
</body>
</html>
