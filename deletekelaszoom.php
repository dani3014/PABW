<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "finansiap");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Periksa apakah ID diterima
if (isset($_POST['class_id'])) {
    $id = $_POST['class_id'];
    
    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $koneksi->prepare("DELETE FROM zoom_classes WHERE class_id = ?");
    $stmt->bind_param("i", $id);

    // Jalankan query
    if ($stmt->execute()) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "ID tidak diterima";
}

// Tutup koneksi ke database
$koneksi->close();
?>
