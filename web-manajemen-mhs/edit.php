<?php
include 'db_connection.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mahasiswa = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT nim, nama, email, jurusan FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $mahasiswa = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data mahasiswa tidak ditemukan.'); window.location.href='index.php';</script>";
        exit;
    }
    $stmt->close();
} else {
    echo "<script>alert('ID mahasiswa tidak valid.'); window.location.href='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white p-8 md:p-12 rounded-xl shadow-2xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">Edit Data Mahasiswa</h2>
        
        <form action="update_process.php" method="POST" class="space-y-6">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div>
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                <input type="text" id="nim" name="nim" value="<?php echo htmlspecialchars($mahasiswa['nim']); ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($mahasiswa['email']); ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($mahasiswa['jurusan']); ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div class="flex items-center justify-between pt-4">
                 <a href="index.php" class="text-gray-600 hover:text-blue-600 font-medium py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>Batal
                </a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-sync-alt mr-2"></i>Update Data
                </button>
            </div>
        </form>
    </div>
    <footer class="text-center py-6 mt-10 text-gray-600 text-sm">
        &copy; <?php echo date("Y"); ?> Sistem Informasi Data Mahasiswa.
    </footer>
</body>
</html>
<?php $conn->close(); ?>