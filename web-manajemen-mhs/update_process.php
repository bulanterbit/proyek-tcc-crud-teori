<?php
include 'db_connection.php';

$message = "";
$message_type = ""; // "success" atau "error"
$redirect_url = "index.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nim = $conn->real_escape_string(trim($_POST['nim']));
    $nama = $conn->real_escape_string(trim($_POST['nama']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $jurusan = $conn->real_escape_string(trim($_POST['jurusan']));

    if ($id <= 0) {
        $message = "ID mahasiswa tidak valid.";
        $message_type = "error";
    } elseif (empty($nim) || empty($nama) || empty($email) || empty($jurusan)) {
        $message = "Semua field wajib diisi.";
        $message_type = "error";
        $redirect_url = "edit.php?id=$id";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid.";
        $message_type = "error";
        $redirect_url = "edit.php?id=$id";
    } else {
        // Cek duplikasi NIM atau Email, kecuali untuk data mahasiswa yang sedang diedit
        $check_sql = "SELECT nim, email FROM mahasiswa WHERE (nim = ? OR email = ?) AND id != ? LIMIT 1";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bind_param("ssi", $nim, $email, $id);
        $stmt_check->execute();
        $check_result = $stmt_check->get_result();

        if ($check_result->num_rows > 0) {
            $existing = $check_result->fetch_assoc();
            if ($existing['nim'] == $nim) {
                $message = "NIM sudah terdaftar untuk mahasiswa lain.";
            } else {
                $message = "Email sudah terdaftar untuk mahasiswa lain.";
            }
            $message_type = "error";
            $redirect_url = "edit.php?id=$id";
        } else {
            $stmt_update = $conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, jurusan = ? WHERE id = ?");
            $stmt_update->bind_param("ssssi", $nim, $nama, $email, $jurusan, $id);

            if ($stmt_update->execute()) {
                $message = "Data mahasiswa berhasil diperbarui!";
                $message_type = "success";
            } else {
                $message = "Error updating record: " . $stmt_update->error;
                $message_type = "error";
                $redirect_url = "edit.php?id=$id";
            }
            $stmt_update->close();
        }
        $stmt_check->close();
    }
} else {
    header("Location: index.php");
    exit();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Update</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <?php if ($message_type === "success"): ?>
        <meta http-equiv="refresh" content="2;url=<?php echo $redirect_url; ?>">
    <?php endif; ?>
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
        <a href="<?php echo $redirect_url; ?>" 
           class="<?php echo $message_type === 'success' ? 'bg-blue-500 hover:bg-blue-600' : 'bg-yellow-500 hover:bg-yellow-600'; ?> text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            <?php echo $message_type === 'success' ? 'Kembali ke Daftar' : 'Coba Lagi'; ?>
        </a>
         <?php if ($message_type !== 'success'): ?>
            <a href="index.php" class="inline-block ml-2 text-gray-600 hover:text-blue-600 font-medium py-2 px-4 rounded-lg transition duration-300">
                Kembali ke Daftar
            </a>
        <?php endif; ?>
    </div>
</body>
</html>