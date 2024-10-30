
<?php
require_once '../Controller/UserController.php';

$userController = new UserController();

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $users = $userController->getAllUsers(); // Fetch users to display the current values
    $user_data = null;

    foreach ($users as $user) {
        if ($user['id_user'] == $id_user) {
            $user_data = $user;
            break;
        }
    }

    if (!$user_data) {
        echo "User not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $userController->updateUser($_POST);
    
    if ($result) {
        header('Location: view.php?status=updated'); // Redirect ke view.php dengan status updated
        exit();
    } else {
        echo "Failed to update user.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../css/output.css" rel="stylesheet" />
  <title>Update Buku</title>
  <!-- Font Family -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="scroll-smooth font-fontMain">
  <main class="w-full h-screen grid grid-cols-5">
    <?php require '../Controller/sidebar.php'; ?>
    <div class="col-span-4 w-full">
      <?php require '../Controller/navbar.php'; ?>
      <div class="max-w mx-7 py-4">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Edit Siswa</h1>
        <form action="edit.php?id=<?= $id_user ?>" method="POST" class="space-y-6">
    <input type="hidden" name="id_user" value="<?= $user_data['id_user'] ?>">

    <!-- Nama Lengkap -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
        <input type="text" name="nama_lengkap" value="<?= $user_data['nama_lengkap'] ?>" required 
               placeholder="Masukkan nama lengkap..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- NIS -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">NIS <span class="text-red-500">*</span></label>
        <input type="text" name="nis" value="<?= $user_data['nis'] ?>" required 
               placeholder="Masukkan NIS..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- NISN -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">NISN <span class="text-red-500">*</span></label>
        <input type="text" name="nisn" value="<?= $user_data['nisn'] ?>" required 
               placeholder="Masukkan NISN..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Kelas -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Kelas <span class="text-red-500">*</span></label>
        <input type="text" name="kelas" value="<?= $user_data['kelas'] ?>" required 
               placeholder="Masukkan kelas..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- No Whatsapp -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">No Whatsapp <span class="text-red-500">*</span></label>
        <input type="text" name="no_whatsapp" value="<?= $user_data['no_whatsapp'] ?>" required 
               placeholder="Masukkan No Whatsapp..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" 
               placeholder="Masukkan password baru..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- No Kartu -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">No Kartu <span class="text-red-500">*</span></label>
        <input type="text" name="no_kartu" value="<?= $user_data['no_kartu'] ?>" required 
               placeholder="Masukkan No Kartu..."
               class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Role Hidden -->
    <input type="hidden" name="roles" value="user">

    <!-- Update Button -->
    <div class="flex justify-center">
        <button type="submit" name="edit" 
                class="inline-block w-[100%] bg-main hover:bg-purple-700 text-white font-semibold rounded-full px-5 py-4 focus:outline-none focus:ring-4 focus:bg-main">
            Update User
        </button>
    </div>
</form>

    </div>
</body>
</html>

