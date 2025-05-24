<?php
// Kthe përgjigje si JSON
header('Content-Type: application/json');

// Marrja e të dhënave nga forma
$emri = trim($_POST['emri'] ?? '');
$mbiemri = trim($_POST['mbiemri'] ?? '');
$emri_perdoruesit = trim($_POST['emri_perdoruesit'] ?? '');
$email = trim($_POST['email'] ?? '');
$datelindja = $_POST['datelindja'] ?? '';
$fjalekalimi = $_POST['password'] ?? '';
$roli = $_POST['roli'] ?? 'user'; // default te user nëse mungon

// RegEx për validim
$regex_emri = "/^[A-ZÇË][a-zçë]{2,}$/u";
$regex_perdorues = "/^[a-zA-Z0-9_]{4,15}$/";
$regex_email = "/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/";
$regex_datelindja = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/";
$regex_fjalekalim = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$/";

// Lista e gabimeve
$gabime = [];

// Validime
if (!preg_match($regex_emri, $emri)) {
    $gabime[] = "Emri duhet të fillojë me shkronjë të madhe dhe të ketë së paku 3 shkronja.";
}

if (!preg_match($regex_emri, $mbiemri)) {
    $gabime[] = "Mbiemri duhet të fillojë me shkronjë të madhe dhe të ketë së paku 3 shkronja.";
}

if (!preg_match($regex_perdorues, $emri_perdoruesit)) {
    $gabime[] = "Emri i përdoruesit duhet të ketë 4-15 karaktere (shkronja, numra ose _).";
}

if (!preg_match($regex_email, $email)) {
    $gabime[] = "Email-i nuk është në format të saktë.";
}

if (!preg_match($regex_datelindja, $datelindja)) {
    $gabime[] = "Datëlindja duhet të jetë në formatin YYYY-MM-DD (p.sh. 2000-05-21).";
}

if (!preg_match($regex_fjalekalim, $fjalekalimi)) {
    $gabime[] = "Fjalëkalimi duhet të ketë së paku 6 karaktere, një shkronjë të madhe, një të vogël dhe një numër.";
}

// Kthe përgjigje si JSON
// Nëse nuk ka gabime, ruaje në databazë
if (empty($gabime)) {
    require 'db.php'; // lidhja me databazë

    $hashedPassword = password_hash($fjalekalimi, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (emri, mbiemri, emri_perdoruesit, email, datelindja, password, Roli) VALUES (?, ?, ?, ?, ?, ?, ?)");
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
    $conn->close();
} else {
    // Kthe gabimet në format JSON
    echo json_encode([
        "sukses" => false,
        "gabime" => $gabime
    ]);
}
?>
