<?php
// create.php
include_once '../core/Database.php';
include_once '../Models/Buku.php';

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buku->kode_buku = $_POST['kode_buku'];
    $buku->judul_buku = $_POST['judul_buku'];
    $buku->kategori = $_POST['kategori'];
    $buku->penerbit = $_POST['penerbit'];
    $buku->sinopsis = $_POST['sinopsis'];
    $buku->stok_buku = $_POST['stok_buku'];

    // Handle file upload for cover
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $buku->cover = $target_file;
        }
    }

    if($buku->create()) {
        echo "Buku berhasil ditambahkan.";
        header("Location: index.php");
    } else {
        echo "Gagal menambahkan buku.";
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
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Tambah Buku Baru</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="space-y-6">
        
        <!-- Kode Buku -->
        <div class="mb-4">
            <label for="kode_buku" class="block text-sm font-medium text-gray-700">Kode Buku <span class="text-red-500">*</span></label>
            <input type="text" id="kode_buku" name="kode_buku" required placeholder="Masukkan kode buku..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <!-- Judul Buku -->
        <div class="mb-4">
            <label for="judul_buku" class="block text-sm font-medium text-gray-700">Judul Buku <span class="text-red-500">*</span></label>
            <input type="text" id="judul_buku" name="judul_buku" required placeholder="Masukkan judul buku terbaru..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <!-- Kategori -->
        <div class="mb-4">
            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Buku <span class="text-red-500">*</span></label>
            <select id="kategori" name="kategori" required class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="Umum">Umum</option>
                <option value="Psikologi">Psikologi</option>
                <option value="Agama">Agama</option>
                <option value="Sosial">Sosial</option>
                <option value="Bahasa">Bahasa</option>
                <option value="Ilmu Murni">Ilmu Murni</option>
                <option value="Ilmu Terapan">Ilmu Terapan</option>
                <option value="Kesenian & Olahraga">Kesenian & Olahraga</option>
                <option value="Fiksi dan Dongeng">Fiksi dan Dongeng</option>
                <option value="Biografi / Sejarah">Biografi / Sejarah</option>
            </select>
        </div>
        
        <!-- Cover Buku -->
        <div class="mb-6">
            <label for="cover" class="block text-sm font-medium text-gray-700">Cover Buku <span class="text-red-500">*</span></label>
            <input type="file" id="cover" name="cover" class="hidden">
            <label for="cover" class="mt-2 inline-block px-10 py-4 text-sm bg-gray-700 text-white rounded-full cursor-pointer text-center">
                Upload Image
            </label>
        </div>
        
        <!-- Penerbit Buku -->
        <div class="mb-4">
            <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit <span class="text-red-500">*</span></label>
            <input type="text" id="penerbit" name="penerbit" required placeholder="Masukkan nama penerbit buku..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <!-- Sinopsis Buku -->
        <div class="mb-4">
            <label for="sinopsis" class="block text-sm font-medium text-gray-700">Sinopsis Buku <span class="text-red-500">*</span></label>
            <textarea id="sinopsis" name="sinopsis" rows="4" required placeholder="Masukkan keterangan sinopsis buku..." class="block w-full border rounded-xl px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
        </div>
        
        <!-- Stok Buku -->
        <div class="mb-4">
            <label for="stok_buku" class="block text-sm font-medium text-gray-700">Stok Buku <span class="text-red-500">*</span></label>
            <input type="number" id="stok_buku" name="stok_buku" required placeholder="Masukkan jumlah kapasitas buku..." class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <!-- Simpan Button -->
        <div class="flex justify-center">
            <button type="submit" class="inline-block w-[100%] bg-main hover:bg-purple-700 text-white font-semibold rounded-full px-5 py-4 focus:outline-none focus:ring-4 focus:bg-main">Tambah Buku</button>
        </div>
        
    </form>
</div>

    </div>
    </main>
</body>
</html>
