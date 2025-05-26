<?php
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

$adminId = $_SESSION['user_id'];

// Sigurohu që tabela shpalljet ka kolonën user_id
$sql = "SELECT id, titulli, kompania, data_publikimit, paga, lokacioni FROM shpalljet WHERE user_id = ? ORDER BY data_publikimit DESC";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Gabim në query: " . $con->error);
}

$stmt->bind_param("i", $adminId);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Shpalljet e mia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f1f1;
            margin-top: 100px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #264653;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            font-size: 15px;
        }
        th {
            background-color: #2a9d8f;
            color: white;
            text-align: center;
        }
        td {
            vertical-align: middle !important;
        }
        .btn-primary {
            background-color: #2a9d8f;
            border: none;
        }
        .btn-danger {
            background-color: #e76f51;
            border: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Shpalljet e Krijuara</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Pozita</th>
                <th>Kompania</th>
                <th>Data</th>
                <th>Paga</th>
                <th>Lokacioni</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['titulli']) ?></td>
                <td><?= htmlspecialchars($row['kompania']) ?></td>
                <td><?= htmlspecialchars($row['data_publikimit']) ?></td>
                <td><?= htmlspecialchars($row['paga']) ?> €</td>
                <td><?= htmlspecialchars($row['lokacioni']) ?></td>
                <td class="text-center">
                    <a href="editShpallje.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edito</a>
                    <a href="fshiShpallje.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('A jeni i sigurt që dëshironi ta fshini?')">Fshij</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
