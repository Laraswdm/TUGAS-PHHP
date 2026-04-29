<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);
    $new_status = $conn->real_escape_string($_POST['status']);

    // Memperbarui status berdasarkan ID baris
    $sql = "UPDATE bookings SET status='$new_status' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); // Kembali ke halaman admin setelah sukses
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>