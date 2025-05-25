<?php
require 'db.php';
$sql1 = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(50) NOT NULL,
    mbiemri VARCHAR(50) NOT NULL,
    emri_perdoruesit VARCHAR(50) NOT NULL UNIQUE,
    datelindja DATE NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    Roli ENUM('admin', 'user') NOT NULL DEFAULT 'user'
)";
$sql2 = "CREATE TABLE IF NOT EXISTS shpalljet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulli VARCHAR(50) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    pershkrimi TEXT NOT NULL,
    kompania VARCHAR(50) NOT NULL,
    lokacioni VARCHAR(50) NOT NULL,
    paga DECIMAL(10,2) NOT NULL,
    data_publikimit DATE NOT NULL DEFAULT curdate(),
    afati DATE NOT NULL,
    kerkesa TEXT NOT NULL,
)";

if (mysqli_query($con, $sql1)) {
    echo "Tabela 'users' u krijua me sukses.<br>";
} else {
    echo "Gabim në krijimin e tabelës 'users': " . mysqli_error($con) . "<br>";
}

if (mysqli_query($con, $sql2)) {
    echo "Tabela 'shpalljet' u krijua me sukses.<br>";
} else {
    echo "Gabim në krijimin e tabelës 'shpalljet': " . mysqli_error($con) . "<br>";
}

mysqli_close($con);

?>