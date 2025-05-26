<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['roli'] !== 'admin') {
    header("Location: index.php?mesazh=Nuk+keni+akses");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $shpalljeId = $_GET['id'];
    $adminId = $_SESSION['user_id'];

    // Sigurohu që është shpallje e këtij admini
    $stmt = $con->prepare("DELETE FROM shpalljet WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $shpalljeId, $adminId);

    if ($stmt->execute()) {
        header("Location: dashboard.php?mesazh=Shpallja+u+fshi+me+sukses");
        exit();
    } else {
        echo "❌ Gabim gjatë fshirjes: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ ID e pavlefshme.";
}
?>
