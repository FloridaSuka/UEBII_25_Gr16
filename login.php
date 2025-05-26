<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';
header('Content-Type: application/json');

// Inicimi i variablave të sesionit për tentimet
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['last_attempt_time'])) {
    $_SESSION['last_attempt_time'] = 0;
}

// Kontrollo nëse POST vjen siç duhet
if (!isset($_POST['emri_perdoruesit']) || !isset($_POST['password'])) {
    echo json_encode([
        "sukses" => false,
        "mesazh" => "Të dhënat nuk u pranuan."
    ]);
    exit;
}

$username = trim($_POST['emri_perdoruesit']);
$password = trim($_POST['password']);
$redirect = $_POST['redirect'] ?? 'home.php';

// Kontrollo nëse ka kaluar limiti prej 3 tentativash
if ($_SESSION['login_attempts'] >= 3) {
    $now = time();
    $diff = $now - $_SESSION['last_attempt_time'];

    if ($diff < 300) {
        $remaining = 300 - $diff;
        echo json_encode([
            "sukses" => false,
            "mesazh" => "Ke provuar shumë herë. Provo përsëri pas " . ceil($remaining / 60) . " minutash."
        ]);
        exit;
    } else {
        $_SESSION['login_attempts'] = 0;
    }
}

$stmt = $con->prepare("SELECT * FROM users WHERE emri_perdoruesit = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (!empty($user['password']) && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['emri'] = $user['emri'];
        $_SESSION['mbiemri'] = $user['mbiemri'];
        $_SESSION['roli'] = $user['Roli'];
        $_SESSION['emri_perdoruesit'] = $user['emri_perdoruesit'];
        $_SESSION['login_attempts'] = 0;

        echo json_encode([
            "sukses" => true,
            "redirect" => ($user['Roli'] === 'admin') ? "home.php" : $redirect
        ]);
        exit;
    } else {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        sleep(5);
        echo json_encode(["sukses" => false, "mesazh" => "Fjalëkalimi është gabim."]);
        exit;
    }
} else {
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();
    sleep(3);
    echo json_encode(["sukses" => false, "mesazh" => "Përdoruesi nuk ekziston."]);
    exit;
}

$stmt->close();
$con->close();
?>
