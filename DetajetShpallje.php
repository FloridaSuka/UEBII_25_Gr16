<?php
session_start();
require 'db.php';
include 'nav.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2 style='color: red; text-align: center;'>ID e shpalljes mungon ose nuk është valide.</h2>";
    exit();
}

$id = (int)$_GET['id'];
$stmt = $con->prepare("SELECT titulli, foto, pershkrimi, kerkesa FROM shpalljet WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$shpallja = $result->fetch_assoc();
$stmt->close();

if (!$shpallja) {
    echo "<h2 style='color: red; text-align: center;'>Shpallja nuk u gjet.</h2>";
    exit();
}

// për aplikim
define("MIN_AGE", 18);
define("MAX_AGE", 65);

function isValidEmailOrPhone($input) {
    return preg_match("/^[\w\-.]+@[\w\-]+\.\w{2,4}$/", $input) ||
           preg_match("/^\+?[0-9]{8,15}$/", $input);
}
function isCapitalized($str) {
    return preg_match("/^[A-ZÇË]/", $str);
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST['first-name'] ?? '';
    $lastName = $_POST['last-name'] ?? '';
    $contact = $_POST['phone-or-email'] ?? '';
    $age = $_POST['age'] ?? 0;
    $city = $_POST['qyteti'] ?? '';
    $experience = $_POST['experience'] ?? 'jo';
    $motivation = $_POST['motivation'] ?? '';
    $cvPath = '';

    if ($_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'cv_files/';
        $ext = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['pdf', 'doc', 'docx'])) {
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $cvPath = $uploadDir . uniqid('cv_') . '.' . $ext;
            move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath);
        } else {
            $errors[] = "Lejohen vetëm .pdf, .doc, .docx";
        }
    } else {
        $errors[] = "Ju lutem ngarkoni CV-në.";
    }

    if (!isCapitalized($firstName)) $errors[] = "Emri duhet me shkronjë të madhe.";
    if (!isCapitalized($lastName)) $errors[] = "Mbiemri duhet me shkronjë të madhe.";
    if (!isValidEmailOrPhone($contact)) $errors[] = "Forma e kontaktit është e pavlefshme.";
    if ($age < MIN_AGE || $age > MAX_AGE) $errors[] = "Mosha duhet të jetë 18–65.";

    if (empty($errors)) {
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['cv_path'] = $cvPath;
        $_SESSION['motivation'] = $motivation;
        header("Location: aplikimi.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Detajet e Shpalljes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .form-section {
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            background-color: #f6fbff;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-section input, .form-section select, .form-section textarea {
            width: 100%;
            padding: 10px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-section input[type="submit"] {
            background-color: #264653;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .form-section input[type="submit"]:hover {
            background-color: #21867a;
        }
    </style>
</head>
<body>

<div class="form-section">
    <h2><?= htmlspecialchars($shpallja['titulli']) ?></h2>
    <img src="<?= htmlspecialchars($shpallja['foto']) ?>" alt="Foto" style="width: 100%; border-radius: 10px;">

    <h4>Përshkrimi:</h4>
    <p><?= nl2br(htmlspecialchars($shpallja['pershkrimi'])) ?></p>

    <h4>Kërkesat:</h4>
    <ul>
        <?php foreach (explode("\n", $shpallja['kerkesa']) as $line)
            if (trim($line)) echo "<li>" . htmlspecialchars($line) . "</li>"; ?>
    </ul>

    <hr>
    <h3>Forma e Aplikimit</h3>

    <?php if (!empty($errors)) {
        echo "<div style='color: red;'><ul>";
        foreach ($errors as $err) echo "<li>$err</li>";
        echo "</ul></div>";
    } ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Emri</label>
        <input type="text" name="first-name" required>

        <label>Mbiemri</label>
        <input type="text" name="last-name" required>

        <label>Email ose Nr. Telefonit</label>
        <input type="text" name="phone-or-email" required>

        <label>Mosha</label>
        <input type="number" name="age" min="18" max="65" required>

        <label>Qyteti</label>
        <input list="qyteti" name="qyteti">
        <datalist id="qyteti">
            <option value="Prishtinë"><option value="Pejë"><option value="Mitrovicë">
            <option value="Gjilan"><option value="Prizren">
        </datalist>

        <label>Eksperiencë</label><br>
        <input type="radio" name="experience" value="po" checked> Po
        <input type="radio" name="experience" value="jo"> Jo<br><br>

        <label>Ngarko CV (.pdf, .doc, .docx)</label>
        <input type="file" name="cv" required>

        <label>Letër Motivimi</label>
        <textarea name="motivation" rows="5" required></textarea>

        <br><input type="submit" value="Apliko">
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
