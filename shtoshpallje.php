<?php include 'nav.php'; ?>
<?php
require 'db.php'; // Lidhja me databazën
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $titulli = $_POST['pozita'];
    $pershkrimi = $_POST['pershkrimi'];
    $kompania = $_POST['kompania'];
    $kategoria = $_POST['kategoria'];
    $lokacioni = $_POST['lokacioni'];
    $paga = $_POST['paga'];
    $afati = $_POST['afatiAplikimit'];
    $kerkesa = $_POST['kerkesa'];
    $user_id = $_SESSION['user_id'];
    $data = date("Y-m-d"); // vetë gjenerohet data aktuale

    // Fotoja - ose file ose link
    $foto_path = '';
    if (!empty($_FILES["foto_file"]["name"])) {
        $upload_folder = "foto/";
        $foto_emri = basename($_FILES["foto_file"]["name"]);
        $target_path = $upload_folder . $foto_emri;

        if (move_uploaded_file($_FILES["foto_file"]["tmp_name"], $target_path)) {
            $foto_path = $target_path;
        } else {
            $mesazhSukses = "❌ Ngarkimi i fotos dështoi.";
            exit;
        }
    } elseif (!empty($_POST['foto_link'])) {
        $foto_path = $_POST['foto_link'];
    } else {
        $mesazhSukses = "❌ Ju duhet të vendosni një foto (ngarkim ose link).";
        exit;
    }

    // Insertim në databazë
    $sql = "INSERT INTO shpalljet (titulli, foto, kompania,kategoria, lokacioni, paga, data_publikimit, pershkrimi, afati, kerkesa, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die("Gabim në prepare(): " . $con->error);
    }

   $stmt->bind_param(
    "ssssssssssi",  // 11 shkronja: 10 s = string, 1 i = integer (për user_id)
    $titulli,
    $foto_path,
    $kompania,
    $kategoria,
    $lokacioni,
    $paga,
    $data,
    $pershkrimi,
    $afati,
    $kerkesa,
    $user_id
);


    if ($stmt->execute()) {
        $mesazhSukses = "✅ Shpallja u ruajt me sukses!";
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
    <form method="post" enctype="multipart/form-data">

        <div class="form-group"><label>Pozita:</label>
            <input type="text" name="pozita" class="form-control" required></div>

        <div class="form-group">
            <label>Ngarko Foto (ose vendos link):</label>
            <input type="file" name="foto_file" class="form-control mb-2" accept="image/*">
            <small class="form-text text-muted">OSE</small>
            <input type="text" name="foto_link" class="form-control" placeholder="Vendos linkun e fotos">
        </div>

        <div class="form-group"><label>Kompania :</label>
            <input type="text" name="kompania" class="form-control" required></div>
             <div class="form-group"><label> Kategoria</label>
            <input type="text" name="kategoria" class="form-control" required></div>

        <div class="form-group"><label>Paga (€):</label>
            <input type="text" name="paga" class="form-control" required></div>

        <div class="form-group"><label>Lokacioni:</label>
            <input type="text" name="lokacioni" class="form-control" required></div>

        <div class="form-group"><label>Përshkrimi:</label>
            <textarea name="pershkrimi" class="form-control" rows="4" required></textarea></div>

        <div class="form-group"><label>Kërkesat:</label>
            <textarea name="kerkesa" class="form-control" rows="4" required></textarea></div>

        <div class="form-group"><label>Afati i aplikimit:</label>
            <input type="date" name="afatiAplikimit" class="form-control" required></div>

        <button type="submit" class="btn btn-success">Shto</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
