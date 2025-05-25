<?php
require 'db.php';
header('Content-Type: application/json');
session_start();

$emri_perdoruesit = $_POST['emri_perdoruesit'] ?? '';
$email = $_POST['email'] ?? '';
$old_password = $_POST['old_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Kontrollo fushat
if (!$emri_perdoruesit || !$email || !$old_password || !$new_password || !$confirm_password) {
    echo json_encode(["sukses" => false, "mesazh" => "Ju lutem plotësoni të gjitha fushat."]);
    exit;
}

if ($new_password !== $confirm_password) {
    echo json_encode(["sukses" => false, "mesazh" => "Fjalëkalimi i ri dhe ai i konfirmuar nuk përputhen."]);
    exit;
}

$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
if (!preg_match($regex, $new_password)) {
    echo json_encode(["sukses" => false, "mesazh" => "Fjalëkalimi duhet të ketë të paktën 8 karaktere, një shkronjë të madhe, një të vogël, një numër dhe një simbol."]);
    exit;
}

$stmt = $con->prepare("SELECT id, password FROM users WHERE emri_perdoruesit = ? AND email = ?");
$stmt->bind_param("ss", $emri_perdoruesit, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo json_encode(["sukses" => false, "mesazh" => "Përdoresui nuk u gjet me këto të dhëna."]);
    exit;
}

$user = $result->fetch_assoc();
$verifikim_sukses = false;

// Kontrollo fjalëkalimin e vjetër
if (password_verify($old_password, $user['password'])) {
    $verifikim_sukses = true;
} else {
    // Kontrollo kodin në fajll
    $file_path = __DIR__ . '/logs/kodet_verifikimit.txt';
    if (file_exists($file_path)) {
        $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (
                str_contains($line, "Username: $emri_perdoruesit") &&
                str_contains($line, "Email: $email") &&
                str_contains($line, "Kodi: $old_password")
            ) {
                $verifikim_sukses = true;
                break;
            }
        }
    }
}

if (!$verifikim_sukses) {
    echo json_encode(["sukses" => false, "mesazh" => "Fjalëkalimi i vjetër ose kodi i verifikimit është i pasaktë."]);
    exit;
}

$hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
$update = $con->prepare("UPDATE users SET password = ? WHERE id = ?");
$update->bind_param("si", $hashedPassword, $user['id']);

if ($update->execute()) {
    echo json_encode(["sukses" => true, "mesazh" => "Fjalëkalimi u ndryshua me sukses."]);
} else {
    echo json_encode(["sukses" => false, "mesazh" => "Gabim gjatë ndryshimit të fjalëkalimit."]);
}

$stmt->close();
$update->close();
$con->close();
?>
