<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';
header('Content-Type: application/json');

// 💡 Kontrollo nëse POST vjen siç duhet
if (!isset($_POST['emri_perdoruesit']) || !isset($_POST['password'])) {
    echo json_encode([
        "sukses" => false,
        "mesazh" => "Të dhënat nuk u pranuan."
    ]);
    exit;
}

$username = $_POST['emri_perdoruesit'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $con->prepare("SELECT * FROM users WHERE emri_perdoruesit = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['emri'] = $user['emri'];
        $_SESSION['mbiemri'] = $user['mbiemri'];
        $_SESSION['roli'] = $user['Roli'];
         $_SESSION['emri_perdoruesit'] = $user['emri_perdoruesit'];

        echo json_encode([
            "sukses" => true,
            "redirect" => ($user['Roli'] === 'admin') ? "adminDashboard.php" : "home.php"
        ]);
    } else {
        echo json_encode(["sukses" => false, "mesazh" => "Fjalëkalimi është gabim."]);
    }
} else {
    echo json_encode(["sukses" => false, "mesazh" => "Përdoruesi nuk ekziston."]);
}


// Vetëm për DEBUG — hiqe kur përfundojnë testet
error_log("LOGIN DEBUG:");
error_log("Përdorues: " . $username);
error_log("Roli: " . $user['Roli']);
error_log("SESSION:");
error_log(print_r($_SESSION, true));

$stmt->close();
$con->close();


?>
