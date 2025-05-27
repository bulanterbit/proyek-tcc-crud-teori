<?php
include 'db_connection.php';

$message = "";
$message_type = ""; // "success" atau "error"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $conn->real_escape_string(trim($_POST['nim']));
    $nama = $conn->real_escape_string(trim($_POST['nama']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $jurusan = $conn->real_escape_string(trim($_POST['jurusan']));

    if (empty($nim) || empty($nama) || empty($email) || empty($jurusan)) {
        $message = "Semua field wajib diisi.";
        $message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid.";
        $message_type = "error";
    } else {
        // Cek duplikasi NIM atau Email
        $check_sql = "SELECT nim, email FROM mahasiswa WHERE nim = '$nim' OR email = '$email' LIMIT 1";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            $existing = $check_result->fetch_assoc();
            if ($existing['nim'] == $nim) {
                $message = "NIM sudah terdaftar. Gunakan NIM lain.";
            } else {
                $message = "Email sudah terdaftar. Gunakan email lain.";
            }
            $message_type = "error";
        } else {
            $sql = "INSERT INTO mahasiswa (nim, nama, email, jurusan) VALUES ('$nim', '$nama', '$email', '$jurusan')";
            if ($conn->query($sql) === TRUE) {
                $message = "Data mahasiswa baru berhasil ditambahkan!";
                $message_type = "success";
                // Redirect setelah beberapa detik atau berikan link
                header("Refresh:2; url=index.php");
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
                $message_type = "error";
            }
        }
    }
} else {
    header("Location: create.php");
    exit();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Penyimpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl text-center max-w-md w-full">
        <?php if ($message_type === "success"): ?>
            <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Berhasil!</h2>
        <?php else: ?>
            <i class="fas fa-times-circle text-red-500 text-5xl mb-4"></i>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Gagal!</h2>
        <?php endif; ?>
        <p class="text-gray-600 mb-6"><?php echo $message; ?></p>
        <?php if ($message_type === "success"): ?>
            <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Kembali ke Daftar
            </a>
        <?php else: ?>
             <a href="create.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 mr-2">
                Coba Lagi
            </a>
            <a href="index.php" class="text-gray-600 hover:text-blue-600 font-medium py-2 px-4 rounded-lg transition duration-300">
                Kembali ke Daftar
            </a>
        <?php endif; ?>
    </div>
</body>
</html>