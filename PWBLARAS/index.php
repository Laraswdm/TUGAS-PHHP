<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paws & Relax | Pet Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Paws & Relax Pet Hotel 🐾</h1>
    <p>Tempat ternyaman untuk sahabat berbulu Anda.</p>
</header>

<div class="container">
    <h2>Formulir Reservasi</h2>
    <p class="subtitle">Isi data sahabat berbulu Anda dan kami akan merawatnya dengan penuh cinta.</p>
    
    <?php
    if (isset($_GET['status']) && $_GET['status'] == 'success') {
        echo "<div class='message success'>Reservasi berhasil dikirim! 🐶🐱</div>";
        echo "<script>if (window.history.replaceState) { window.history.replaceState(null, null, window.location.pathname); }</n</script>";
    }
    ?>

    <form action="process.php" method="POST">
        <div class="form-group">
            <label for="owner_name">Nama Pemilik:</label>
            <input type="text" id="owner_name" name="owner_name" required>
        </div>
        <div class="form-group">
            <label for="pet_name">Nama Hewan Peliharaan:</label>
            <input type="text" id="pet_name" name="pet_name" required>
        </div>
        <div class="form-group">
            <label for="pet_type">Jenis Hewan:</label>
            <select id="pet_type" name="pet_type" required>
                <option value="Kucing">Kucing</option>
                <option value="Anjing">Anjing</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="check_in">Tanggal Check-in:</label>
            <input type="date" id="check_in" name="check_in" required>
        </div>
        <div class="form-group">
            <label for="check_out">Tanggal Check-out:</label>
            <input type="date" id="check_out" name="check_out" required>
        </div>
        <button type="submit">Pesan Sekarang</button>
    </form>
</div>

</body>
</html>