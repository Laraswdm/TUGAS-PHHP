<?php
require 'config.php';
$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="max-width: 1000px;">
    <h2 style="color: var(--dark);">Dashboard Admin</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pemilik</th>
                <th>Hewan</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $badgeClass = 'bg-pending';
                    if ($row['status'] == 'Check-in') $badgeClass = 'bg-checkin';
                    if ($row['status'] == 'Selesai') $badgeClass = 'bg-selesai';

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['owner_name'] . "</td>";
                    echo "<td>" . $row['pet_name'] . "</td>";
                    echo "<td>" . date('d-M-Y', strtotime($row['check_in'])) . "</td>";
                    echo "<td>" . date('d-M-Y', strtotime($row['check_out'])) . "</td>";
                    echo "<td><span class='badge " . $badgeClass . "'>" . $row['status'] . "</span></td>";
                    
                    // Form untuk mengubah status yang mengarah ke update_status.php
                    echo "<td>
                            <form action='update_status.php' method='POST' style='display:flex; gap:10px;'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <select name='status'>
                                    <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                    <option value='Check-in' " . ($row['status'] == 'Check-in' ? 'selected' : '') . ">Check-in</option>
                                    <option value='Selesai' " . ($row['status'] == 'Selesai' ? 'selected' : '') . ">Selesai</option>
                                </select>
                                <button type='submit' style='width:auto; padding:6px 12px; background:#ef233c;'>Update</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Belum ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>