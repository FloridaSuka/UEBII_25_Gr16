<?php
require 'db.php'; // lidhu me databazën

$csvFile = fopen("shpalljet.csv", "r"); // hap fajllin CSV
$first = true;

while (($row = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
    if ($first) { $first = false; continue; } // anashkalo headerin

    // Nxjerr të dhënat nga çdo rresht
    [$titulli, $foto, $kompania, $data, $paga, $lokacioni, $pershkrimi, $afati] = $row;
    $user_id = 1; // ose merre nga $_SESSION nëse e ke

    // Shto në databazë
    $stmt = $con->prepare("INSERT INTO shpalljet 
        (titulli, foto, kompania, data_publikimit, paga, lokacioni, pershkrimi, afati, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssi", $titulli, $foto, $kompania, $data, $paga, $lokacioni, $pershkrimi, $afati, $user_id);
    $stmt->execute();
}

fclose($csvFile); // mbyll fajllin CSV
echo "✅ Importimi u krye me sukses.";
?>
