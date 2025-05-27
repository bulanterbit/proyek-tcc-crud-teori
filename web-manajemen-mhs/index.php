<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-white">Sistem Informasi Data Mahasiswa</h1>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-blue-700">Daftar Mahasiswa</h2>
            <a href="create.php" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Tambah Mahasiswa
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">NIM</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Jurusan</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    <?php
                    $sql = "SELECT id, nim, nama, email, jurusan FROM mahasiswa ORDER BY nama ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b border-gray-200 hover:bg-gray-100 transition duration-150 ease-in-out'>";
                            echo "<td class='py-3 px-6 text-left whitespace-nowrap'>" . htmlspecialchars($row["nim"]) . "</td>";
                            echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["nama"]) . "</td>";
                            echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td class='py-3 px-6 text-left'>" . htmlspecialchars($row["jurusan"]) . "</td>";
                            echo "<td class='py-3 px-6 text-center whitespace-nowrap'>";
                            echo "<a href='edit.php?id=" . $row["id"] . "' class='bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md text-xs mr-2 shadow transition duration-150 ease-in-out'><i class='fas fa-edit mr-1'></i>Edit</a>";
                            echo "<a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data mahasiswa ini?\")' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md text-xs shadow transition duration-150 ease-in-out'><i class='fas fa-trash mr-1'></i>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr class='border-b border-gray-200'><td colspan='5' class='py-3 px-6 text-center text-gray-500'>Tidak ada data mahasiswa.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
<?php $conn->close(); ?>