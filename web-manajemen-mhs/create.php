<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white p-8 md:p-12 rounded-xl shadow-2xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">Tambah Data Mahasiswa</h2>
        
        <form action="save.php" method="POST" class="space-y-6">
            <div>
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                <input type="text" id="nim" name="nim" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" required>
            </div>
            
            <div class="flex items-center justify-between pt-4">
                <a href="index.php" class="text-gray-600 hover:text-blue-600 font-medium py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>Batal
                </a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan Data
                </button>
            </div>
        </form>
    </div>
     <footer class="text-center py-6 mt-10 text-gray-600 text-sm">
        &copy; <?php echo date("Y"); ?> Sistem Informasi Data Mahasiswa.
    </footer>
</body>
</html>