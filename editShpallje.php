<?php
ob_start();
require 'db.php';
session_start();
include 'cookie-box.php';
include 'nav.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['roli'] !== 'admin') {
    header("Location: index.php?mesazh=Nuk+keni+akses");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID e pavlefshme.";
    exit();
}

$id = $_GET['id'];
$adminId = $_SESSION['user_id'];

$stmt = $con->prepare("SELECT * FROM shpalljet WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $adminId);
$stmt->execute();
$result = $stmt->get_result();
$shpallja = $result->fetch_assoc();
$stmt->close();

if (!$shpallja) {
    echo "❌ Shpallja nuk ekziston ose nuk është e juaja.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulli = $_POST['titulli'];
    $kompania = $_POST['kompania'];
    $lokacioni = $_POST['lokacioni'];
    $paga = $_POST['paga'];
    $pershkrimi = $_POST['pershkrimi'];
    $kerkesa = $_POST['kerkesa'];
    $afati = $_POST['afati'];

    $stmt = $con->prepare("UPDATE shpalljet SET titulli=?, kompania=?, lokacioni=?, paga=?, pershkrimi=?, kerkesa=?, afati=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sssssssii", $titulli, $kompania, $lokacioni, $paga, $pershkrimi, $kerkesa, $afati, $id, $adminId);

    if ($stmt->execute()) {
        header("Location: dashboard.php?mesazh=Shpallja+u+ndryshua+me+sukses");
        exit();
    } else {
        echo "❌ Gabim: " . $stmt->error;
    }
    $stmt->close();
}



ob_end_flush();
?>


<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edito Shpallje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f4f4; font-family: 'Poppins', sans-serif; }
        .container-box {
            max-width: 800px; margin: 50px auto; background: #fff;
            padding: 30px; border-radius: 20px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        }
        h3 { text-align: center; color: #264653; font-weight: bold; }
        .btn-success {
            background-color: #2a9d8f; padding: 10px 30px; float: right;
            border: none;
        }
        .btn-success:hover { background-color: #21867a; }
    </style>
</head>
<body>
<div class="container-box">
    <h3>Edito Shpalljen</h3>
    <form method="POST">
        <div class="form-group"><label>Pozita:</label>
            <input type="text" name="titulli" value="<?= htmlspecialchars($shpallja['titulli']) ?>" class="form-control" required></div>
        <div class="form-group"><label>Kompania:</label>
            <input type="text" name="kompania" value="<?= htmlspecialchars($shpallja['kompania']) ?>" class="form-control" required></div>
        <div class="form-group"><label>Lokacioni:</label>
            <input type="text" name="lokacioni" value="<?= htmlspecialchars($shpallja['lokacioni']) ?>" class="form-control" required></div>
        <div class="form-group"><label>Paga (€):</label>
            <input type="text" name="paga" value="<?= htmlspecialchars($shpallja['paga']) ?>" class="form-control" required></div>
        <div class="form-group"><label>Përshkrimi:</label>
            <textarea name="pershkrimi" class="form-control" rows="4"><?= htmlspecialchars($shpallja['pershkrimi']) ?></textarea></div>
        <div class="form-group"><label>Kërkesat:</label>
            <textarea name="kerkesa" class="form-control" rows="4"><?= htmlspecialchars($shpallja['kerkesa']) ?></textarea></div>
        <div class="form-group"><label>Afati i aplikimit:</label>
            <input type="date" name="afati" value="<?= htmlspecialchars($shpallja['afati']) ?>" class="form-control" required></div>

        <button type="submit" class="btn btn-success">Ruaj Ndryshimet</button>
        <a href="dashboard.php" class="btn btn-secondary">Anulo</a>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
