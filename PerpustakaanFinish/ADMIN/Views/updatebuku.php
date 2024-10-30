<?php
// update.php
include_once '../core/Database.php';
include_once '../Models/Buku.php';

$database = new Database();
$db = $database->getConnection();

$buku = new Buku($db);

if(isset($_GET['id'])) {
    $buku->id_buku = $_GET['id'];
    $buku->readOne();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = isset($_POST['id_buku']) ? $_POST['id_buku'] : die('ID tidak ditemukan.');
    $buku->kode_buku = $_POST['kode_buku'];
    $buku->judul_buku = $_POST['judul_buku'];
    $buku->kategori = $_POST['kategori'];
    $buku->penerbit = $_POST['penerbit'];
    $buku->sinopsis = $_POST['sinopsis'];
    $buku->stok_buku = $_POST['stok_buku'];

    if(isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["cover"]["name"]);

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $buku->cover = basename($target_file);
        }
    } else {
        $buku->cover = $buku->getOldCover($id_buku);
    }

    if ($buku->update($id_buku)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Terjadi kesalahan saat memperbarui buku.";
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
        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Update Buku</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="space-y-6">
          <input type="hidden" name="id_buku" value="<?php echo $buku->id_buku; ?>">

          <!-- Looping untuk input fields -->
          <?php
          $fields = [
              "kode_buku" => "Kode Buku",
              "judul_buku" => "Judul Buku",
              "penerbit" => "Penerbit",
              "stok_buku" => "Stok Buku"
          ];

          foreach ($fields as $field => $label) {
              $value = $buku->$field;
              $type = ($field === 'stok_buku') ? 'number' : 'text';
              echo "
              <div class='mb-4'>
                  <label class='block text-sm font-medium text-gray-700'>$label <span class='text-red-500'>*</span></label>
                  <input type='$type' name='$field' value='$value' required placeholder='Masukkan $label...'
                      class='mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm'>
              </div>";
          }
          ?>

          <!-- Kategori Buku -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Kategori Buku <span class="text-red-500">*</span></label>
            <select name="kategori" required class="mt-1 block w-full rounded-full border px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <?php
              $categories = ["Umum", "Psikologi", "Agama", "Sosial", "Bahasa", "Ilmu Murni", "Ilmu Terapan", "Kesenian", "Fiksi dan Dongeng", "Biografi / Sejarah"];
              foreach ($categories as $category) {
                  $selected = ($buku->kategori == $category) ? "selected" : "";
                  echo "<option value='$category' $selected>$category</option>";
              }
              ?>
            </select>
          </div>

          <!-- Cover Buku -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Cover Buku <span class="text-red-500">*</span></label>
            <input type="file" name="cover" id="cover" class="hidden">
            <label for="cover" class="mt-2 inline-block px-10 py-4 text-sm bg-gray-700 text-white rounded-full cursor-pointer text-center">
              Upload Image
            </label>
            <?php if($buku->cover): ?>
              <img src="../uploads/<?php echo $buku->cover; ?>" alt="Current cover" class="mt-2" width="100">
            <?php endif; ?>
          </div>

          <!-- Sinopsis Buku -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Sinopsis Buku <span class="text-red-500">*</span></label>
            <textarea name="sinopsis" rows="4" required placeholder="Masukkan sinopsis buku..." class="block w-full border rounded-xl px-5 py-4 border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo $buku->sinopsis; ?></textarea>
          </div>

          <!-- Button Simpan -->
          <div class="flex justify-center">
            <button type="submit" class="inline-block w-[100%] bg-main hover:bg-purple-700 text-white font-semibold rounded-full px-5 py-4 focus:outline-none focus:ring-4 focus:bg-main">
              Update Buku
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
