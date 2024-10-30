<?php
require_once '../Controller/UserController.php';
$userController = new UserController();
$users = $userController->getAllUsers();
$i = 1; // Inisialisasi nomor urut
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
          <input type="text" id="search" placeholder="Search" class="w-full pl-4 pr-10 py-2 rounded-full bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300" onkeyup="liveSearch()">
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
              <h1 class="text-2xl font-bold">Daftar Siswa</h1>
          </div>
      
          <!-- Button and Dropdown Section -->
          <div class="flex justify-between items-center mb-4">
              <button type="button" class="inline-flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><a href="create.php">Tambah</a></button>
      
              <!-- Dropdown Button -->
              
          </div>
      </div>
        
      <div class="overflow-x-auto mt-3 ml-4" id="userTable">
    <table class="min-w-full bg-white shadow-md rounded-lg border-collapse table-auto">
        <thead>
            <tr class="text-left bg-gray-200 font-bold text-gray-600 uppercase text-sm">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Nama Lengkap</th>
                <th class="py-2 px-4">NIS</th>
                <th class="py-2 px-4">NISN</th>
                <th class="py-2 px-4">Kelas</th>
                <th class="py-2 px-4">No Whatsapp</th>
                <th class="py-2 px-4">No Kartu</th>
                <th class="py-2 px-4">Roles</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $i => $user) : ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-4 text-left whitespace-nowrap"><?= $i + 1; ?></td> 
                    <td class="py-2 px-4 text-left"><?= $user['nama_lengkap'] ?></td>
                    <td class="py-2 px-4 text-left"><?= $user['nis'] ?></td>
                    <td class="py-2 px-4 text-left"><?= $user['nisn'] ?></td>
                    <td class="py-2 px-4 text-left"><?= $user['kelas'] ?></td>
                    <td class="py-2 px-4 text-left"><?= $user['no_whatsapp'] ?></td>
                    <td class="py-2 px-4 text-left"><?= $user['no_kartu'] ?></td>
                    <td class="py-2 px-4 text-left"><?= $user['roles'] ?></td>
                    <td class="py-2 px-4 text-left">
                        <a href="edit.php?id=<?= $user['id_user'] ?>" class="text-blue-600">Edit</a>
                        <button onclick="confirmDelete(<?= $user['id_user'] ?>)" class="text-red-700 ml-2">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    </div>
</main>
    <!-- SweetAlert Script -->
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Hapus Data Siswa',
                text: "Data yang dipilih akan dihapus secara permanen, yakin ingin menghapus data tersebut?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak, Terima Kasih'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?id=' + userId;
                }
            });
        }
    </script>
    <script>
    function liveSearch() {
        const searchValue = document.getElementById('search').value;
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "search.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('userTable').innerHTML = xhr.responseText;
            }
        };
        xhr.send("query=" + searchValue);
    }
</script>

</body>
</html>
