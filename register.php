<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
session_start();
require 'db.php';

// Marrja e të dhënave
$emri = trim($_POST['emri'] ?? '');
$mbiemri = trim($_POST['mbiemri'] ?? '');
$emri_perdoruesit = trim($_POST['emri_perdoruesit'] ?? '');
$email = trim($_POST['email'] ?? '');
$datelindja = $_POST['datelindja'] ?? '';
$fjalekalimi = $_POST['password'] ?? '';
$roli = $_POST['roli'] ?? 'user';

// Validime
$regex_emri = "/^[A-ZÇË][a-zçë]{2,}$/u";
$regex_perdorues = "/^[a-zA-Z0-9_]{4,15}$/";
$regex_email = "/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/";
$regex_datelindja = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/";
$regex_fjalekalim = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$/";

$gabime = [];

if (!preg_match($regex_emri, $emri)) $gabime[] = "Emri duhet të fillojë me shkronjë të madhe dhe të ketë së paku 3 shkronja.";
if (!preg_match($regex_emri, $mbiemri)) $gabime[] = "Mbiemri duhet të fillojë me shkronjë të madhe dhe të ketë së paku 3 shkronja.";
if (!preg_match($regex_perdorues, $emri_perdoruesit)) $gabime[] = "Emri i përdoruesit duhet të ketë 4-15 karaktere (shkronja, numra ose _).";
if (!preg_match($regex_email, $email)) $gabime[] = "Email-i nuk është në format të saktë.";
if (!preg_match($regex_datelindja, $datelindja)) $gabime[] = "Datëlindja duhet të jetë në formatin YYYY-MM-DD (p.sh. 2000-05-21).";
if (!preg_match($regex_fjalekalim, $fjalekalimi)) $gabime[] = "Fjalëkalimi duhet të ketë së paku 6 karaktere, një shkronjë të madhe, një të vogël dhe një numër.";

if (!empty($gabime)) {
    echo json_encode(["sukses" => false, "gabime" => $gabime]);
    exit;
}

// Kontrollo nëse përdoruesi ose email-i ekziston
$kontrollo = $con->prepare("SELECT id FROM users WHERE emri_perdoruesit = ? OR email = ?");
$kontrollo->bind_param("ss", $emri_perdoruesit, $email);
$kontrollo->execute();
$kontrollo->store_result();

if ($kontrollo->num_rows > 0) {
    echo json_encode([
        "sukses" => false,
        "gabime" => ["Përdoruesi ose email-i tashmë ekziston."]
    ]);
    $kontrollo->close();
    $con->close();
    exit;
}
$kontrollo->close();

// Ruajtja në databazë
$hashedPassword = password_hash($fjalekalimi, PASSWORD_DEFAULT);
$stmt = $con->prepare("INSERT INTO users (emri, mbiemri, emri_perdoruesit, email, datelindja, password, roli) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $emri, $mbiemri, $emri_perdoruesit, $email, $datelindja, $hashedPassword, $roli);

if ($stmt->execute()) {
    echo json_encode([
        "sukses" => true,
        "mesazh" => "Regjistrimi u krye me sukses!",
        "emri" => $emri,
        "mbiemri" => $mbiemri
    ]);
} else {
    echo json_encode([
        "sukses" => false,
        "gabime" => ["Gabim gjatë ruajtjes në databazë: " . $stmt->error]
    ]);
}

$stmt->close();
$con->close();
?>
