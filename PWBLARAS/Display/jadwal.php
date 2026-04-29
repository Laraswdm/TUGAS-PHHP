<?php
// Karena file ini ada di dalam folder 'display', kita naik satu tingkat (../) 
// untuk memanggil config.php
require '../config.php';

// Mengambil data reservasi yang aktif (Pending atau Check-in)
$sql = "SELECT * FROM bookings WHERE status != 'Selesai' ORDER BY check_in ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Reservasi | Paws & Relax</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .schedule-card {
            background: #fff;
            border-radius: 20px;
            padding: 1.5rem;
            border: 2px solid var(--pet-lavender);
            transition: transform 0.3s ease;
        }
        .schedule-card:hover {
            transform: translateY(-5px);
            border-color: var(--pet-pink);
        }
        .date-badge {
            display: inline-block;
            background: var(--pet-mint);
            padding: 5px 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Jadwal Menginap 🗓️</h1>
    <p>Pantau jadwal kedatangan tamu-tamu spesial kami.</p>
</header>

<div class="container" style="max-width: 900px;">
    <h2>Kalender Reservasi</h2>
    <p class="subtitle">Daftar hewan peliharaan yang dijadwalkan menginap dalam waktu dekat.</p>

    <div class="schedule-grid">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Menentukan class badge berdasarkan status
                $statusLabel = $row['status'];
                $badgeColor = ($statusLabel == 'Check-in') ? 'bg-checkin' : 'bg-pending';
                
                echo "<div class='schedule-card'>";
                echo "<div class='date-badge'>" . date('d M', strtotime($row['check_in'])) . " - " . date('d M', strtotime($row['check_out'])) . "</div>";
                echo "<h3 style='margin: 10px 0; color: var(--text);'>" . htmlspecialchars($row['pet_name']) . "</h3>";
                echo "<p style='font-size: 0.9rem; margin: 5px 0;'><strong>Jenis:</strong> " . htmlspecialchars($row['pet_type']) . "</p>";
                echo "<p style='font-size: 0.9rem; margin: 5px 0;'><strong>Pemilik:</strong> " . htmlspecialchars($row['owner_name']) . "</p>";
                echo "<div style='margin-top: 15px;'><span class='badge $badgeColor'>$statusLabel</span></div>";
                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada jadwal aktif saat ini.</p>";
        }
        ?>
    </div>

    <div style="margin-top: 3rem; text-align: center;">
        <a href="../index.php" style="color: #ff90a1; font-weight: bold; text-decoration: none;">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>