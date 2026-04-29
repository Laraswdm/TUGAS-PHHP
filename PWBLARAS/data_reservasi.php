<?php
// Memanggil sambungan pangkalan data
require 'config.php';

// Mengambil data dari jadual bookings yang disusun dari yang paling baharu
$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Reservasi | Paws & Relax</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Senarai Tetamu Kami 🐾</h1>
    <p>Lihat rakan berbulu yang akan menginap di hotel kami.</p>
</header>

<div class="container" style="max-width: 800px;">
    <h2>Data Jawapan Borang</h2>
    <p class="subtitle">Berikut adalah senarai maklumat daripada borang reservasi yang telah berjaya dihantar.</p>

    <?php
    if ($result->num_rows > 0) {
        // Memaparkan data dalam bentuk kad senarai yang kemas
        while($row = $result->fetch_assoc()) {
            // Menentukan warna lencana status
            $badgeClass = 'bg-pending';
            if ($row['status'] == 'Check-in') $badgeClass = 'bg-checkin';
            if ($row['status'] == 'Selesai') $badgeClass = 'bg-selesai';

            // Membina struktur kad untuk setiap data
            echo "<div style='background: #fff; padding: 1.5rem; margin-bottom: 1.2rem; border-radius: 16px; box-shadow: 0 4px 15px var(--shadow); border-left: 6px solid var(--pet-pink);'>";
            echo "<h3 style='margin-top: 0; color: #5b3b5a; font-size: 1.5rem;'>" . htmlspecialchars($row['pet_name']) . " <span style='font-size: 1rem; color: #8e6b8c;'>(" . htmlspecialchars($row['pet_type']) . ")</span></h3>";
            echo "<p style='margin: 0.5rem 0;'><strong>Pemilik:</strong> " . htmlspecialchars($row['owner_name']) . "</p>";
            echo "<p style='margin: 0.5rem 0;'><strong>Tarikh Menginap:</strong> " . date('d M Y', strtotime($row['check_in'])) . " hingga " . date('d M Y', strtotime($row['check_out'])) . "</p>";
            echo "<p style='margin-top: 1rem; margin-bottom: 0;'><strong>Status:</strong> <span class='badge " . $badgeClass . "'>" . $row['status'] . "</span></p>";
            echo "</div>";
        }
    } else {
        echo "<div class='message'>Belum ada data reservasi yang dihantar setakat ini.</div>";
    }
    ?>
    
    <div style="text-align: center; margin-top: 2.5rem;">
        <a href="index.php" style="text-decoration: none;">
            <button style="width: auto;">+ Buat Reservasi Baharu</button>
        </a>
    </div>
</div>

</body>
</html>

<?php
// Menutup sambungan
$conn->close();
?>