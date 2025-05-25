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
$redirect = $_POST['redirect'] ?? 'home.php';

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
            "redirect" => ($user['Roli'] === 'admin') ? "home.php" : $redirect
        ]);
    } else {
        echo json_encode(["sukses" => false, "mesazh" => "Fjalëkalimi është gabim."]);
    }
} else {
    echo json_encode(["sukses" => false, "mesazh" => "Përdoruesi nuk ekziston."]);
}
// Nëse vjen nga redirektimi dhe ka mesazh në URL, shfaq alert
if (isset($_GET['mesazh'])) {
    $mesazh = urldecode($_GET['mesazh']);
    echo "<script>alert('$mesazh');</script>";
}

$stmt->close();
$con->close();


?>
