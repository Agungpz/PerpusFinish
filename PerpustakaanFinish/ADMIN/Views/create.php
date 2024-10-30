<?php
require_once '../Controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userController = new UserController();
    $result = $userController->createUser($_POST);
    echo $result;

      if ($result) { // Jika berhasil
        header("Location: view.php"); // Redirect ke halaman view.php
        exit(); // Pastikan untuk keluar setelah redirect
    } else {
        echo "Gagal menambahkan user. Silakan coba lagi.";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../css/output.css" rel="stylesheet" />
  <title>Tambah Buku</title>
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
    <?php require '../Controller/navbar.php';  ?>
    <div class="max-w mx-7 py-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Tambah Siswa Baru</h1>
    <form action="create.php" method="POST" class="space-y-6">
    <!-- Nama Lengkap -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
        <input type="text" name="nama_lengkap" required placeholder="Masukkan nama lengkap..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- NIS -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">NIS <span class="text-red-500">*</span></label>
        <input type="text" name="nis" required placeholder="Masukkan NIS..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- NISN -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">NISN <span class="text-red-500">*</span></label>
        <input type="text" name="nisn" required placeholder="Masukkan NISN..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Kelas -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Kelas <span class="text-red-500">*</span></label>
        <input type="text" name="kelas" required placeholder="Masukkan kelas..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- No Whatsapp -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">No Whatsapp <span class="text-red-500">*</span></label>
        <input type="text" name="no_whatsapp" required placeholder="Masukkan nomor Whatsapp..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
        <input type="password" name="password" required placeholder="Masukkan password..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- No Kartu -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">No Kartu <span class="text-red-500">*</span></label>
        <input type="text" name="no_kartu" required placeholder="Masukkan nomor kartu..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center">
        <input type="submit" value="Tambah Siswa" class="inline-block w-[100%] bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full px-5 py-4 focus:outline-none focus:ring-4 focus:bg-blue-500">
    </div>
</form>

    </div>
</body>
</html>
