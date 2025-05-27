<?php
include 'db_connection.php';

$message = "";
$message_type = "";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $message = "Data mahasiswa berhasil dihapus!";
                $message_type = "success";
            } else {
                $message = "Data mahasiswa tidak ditemukan atau sudah dihapus.";
                $message_type = "error";
            }
        } else {
            $message = "Error deleting record: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "ID mahasiswa tidak valid.";
        $message_type = "error";
    }
} else {
    $message = "Permintaan tidak valid.";
    $message_type = "error";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Penghapusan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <meta http-equiv="refresh" content="2;url=index.php">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl text-center max-w-md w-full">
        <?php if ($message_type === "success"): ?>
            <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Berhasil!</h2>
        <?php else: ?>
            <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl mb-4"></i>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Pemberitahuan</h2>
        <?php endif; ?>
        <p class="text-gray-600 mb-6"><?php echo $message; ?></p>
        <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            Kembali ke Daftar
        </a>
    </div>
</body>
</html>