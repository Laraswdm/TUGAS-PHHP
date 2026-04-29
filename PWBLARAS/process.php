<?php
// Memanggil koneksi database
require 'config.php';

// Memastikan data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari index.php
    $owner_name = $conn->real_escape_string($_POST['owner_name']);
    $pet_name = $conn->real_escape_string($_POST['pet_name']);
    $pet_type = $conn->real_escape_string($_POST['pet_type']);
    $check_in = $conn->real_escape_string($_POST['check_in']);
    $check_out = $conn->real_escape_string($_POST['check_out']);

    if ($check_out <= $check_in) {
        die("Tanggal Check-out harus setelah Check-in. <a href='index.php'>Kembali</a>");
    }

    // Menyimpan ke database
    $sql = "INSERT INTO bookings (owner_name, pet_name, pet_type, check_in, check_out, status) 
            VALUES ('$owner_name', '$pet_name', '$pet_type', '$check_in', '$check_out', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        // Jika sukses, kembalikan user ke index.php dengan pesan status sukses
        header("Location: index.php?status=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>