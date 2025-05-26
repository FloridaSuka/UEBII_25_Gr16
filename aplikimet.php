<?php
ob_start();
require 'db.php';
include 'nav.php';
include 'cookie-box.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['roli'] !== 'admin') {
    header("Location: index.php?mesazh=Nuk+keni+akses");
    exit();
}

// Merr të gjitha aplikimet me detaje të shpalljeve
$sql = "SELECT a.*, s.titulli 
        FROM aplikimet a 
        JOIN shpalljet s ON a.shpallje_id = s.id 
        ORDER BY a.data_aplikimit DESC";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Aplikimet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            background: #fff;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #264653;
            margin-bottom: 30px;
            font-weight: bold;
        }
        table th {
            background-color: #2a9d8f;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Aplikimet për Shpallje</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Pozita</th>
                <th>Emri</th>
                <th>Email</th>
                <th>Mosha</th>
                <th>Qyteti</th>
                <th>CV</th>
                <th>Letër Motivimi</th>
                <th>Data Aplikimit</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($r = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($r['titulli']) ?></td>
                <td><?= htmlspecialchars($r['emri'] . ' ' . $r['mbiemri']) ?></td>
                <td><?= htmlspecialchars($r['email']) ?></td>
                <td><?= htmlspecialchars($r['mosha']) ?></td>
                <td><?= htmlspecialchars($r['qyteti']) ?></td>
                <td><a href="<?= $r['cv_path'] ?>" target="_blank">Shiko CV</a></td>
                <td><?= nl2br(htmlspecialchars($r['motivimi'])) ?></td>
                <td><?= htmlspecialchars($r['data_aplikimit']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
