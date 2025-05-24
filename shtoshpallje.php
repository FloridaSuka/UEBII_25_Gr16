<?php
require 'db.php'; // Lidhja me databazën

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $con->prepare("INSERT INTO shpalljet (titulli, pershkrimi, kompania, lokacioni, paga, data_publikimit, afati, user_id)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $titulli = $_POST['pozita'];
    $pershkrimi = $_POST['pershkrimi'];
    $kompania = $_POST['kategoria']; // e përdorim për emër të kompanisë
    $lokacioni = $_POST['lokacioni'];
    $paga = $_POST['paga'];
    $data = $_POST['dataShpalljes'];
    $afati = $_POST['afatiAplikimit'];
    $user_id = 1; // nëse do e lidhësh me përdoruesit, vendos ID-n nga session

    $stmt->bind_param("sssssssi", $titulli, $pershkrimi, $kompania, $lokacioni, $paga, $data, $afati, $user_id);

    if ($stmt->execute()) {
        $mesazhSukses = "✅ Shpallja u ruajt në databazë!";
    } else {
        $mesazhSukses = "❌ Gabim: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Shto Shpallje</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f4f4; font-family: 'Poppins', sans-serif; }
        .container-box {
            max-width: 800px; margin: 50px auto; background: #fff;
            padding: 30px; border-radius: 20px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        }
        h2 { text-align: center; color: #264653; font-weight: bold; }
        .btn-success {
            background-color: #2a9d8f; padding: 10px 30px; float: right;
            border: none;
        }
        .btn-success:hover { background-color: #21867a; }
    </style>
</head>
<body>
    <div class="container-box">
        <h2>Shto një shpallje të re</h2>
        <?php if (isset($mesazhSukses)) echo "<div class='alert alert-success'>$mesazhSukses</div>"; ?>
        <form method="post">
           
        
        <div class="form-group"><label>Pozita:</label><input type="text" name="pozita" class="form-control" required></div>
        <div class="form-group">
    <label>Foto (path ose URL):</label>
    <input type="text" name="foto" class="form-control" required>
</div>
  
        <div class="form-group"><label>Kompania (ose Kategoria):</label><input type="text" name="kategoria" class="form-control" required></div>
            <div class="form-group"><label>Data e Shpalljes:</label><input type="date" name="dataShpalljes" class="form-control" required></div>
            <div class="form-group"><label>Paga (€):</label><input type="text" name="paga" class="form-control" required></div>
            <div class="form-group"><label>Lokacioni:</label><input type="text" name="lokacioni" class="form-control" required></div>
            <div class="form-group"><label>Përshkrimi:</label><textarea name="pershkrimi" class="form-control" rows="4" required></textarea></div>
            <div class="form-group"><label>Afati i aplikimit:</label><input type="date" name="afatiAplikimit" class="form-control" required></div>
            <button type="submit" class="btn btn-success">Shto</button>
        </form>
    </div>
</body>
</html>
