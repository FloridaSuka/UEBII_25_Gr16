<?php
require 'db.php';
$sql0 = "CREATE TABLE IF NOT EXISTS aplikimet (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(50) NOT NULL,
    mbiemri VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mosha INT NOT NULL,
    qyteti VARCHAR(50) NOT NULL,
    aftesite TEXT DEFAULT NULL,
    motivimi TEXT NOT NULL,
    cv_path VARCHAR(255) DEFAULT NULL,
    shpallje_id INT(11) NOT NULL,
    data_aplikimit DATE DEFAULT CURDATE(),
    pervoja VARCHAR(50) NOT NULL DEFAULT 'jo',
    FOREIGN KEY (shpallje_id) REFERENCES shpalljet(id) ON DELETE CASCADE
)";
$sql1 = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(50) NOT NULL,
    mbiemri VARCHAR(50) NOT NULL,
    emri_perdoruesit VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    Roli ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    datelindja DATE NOT NULL
)";
$sql2 = "CREATE TABLE IF NOT EXISTS shpalljet (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    titulli VARCHAR(50) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    kompania VARCHAR(50) NOT NULL,
    kategoria VARCHAR(100) DEFAULT NULL,
    lokacioni VARCHAR(100) NOT NULL,
    paga DECIMAL(10,2) NOT NULL,
    data_publikimit DATE NOT NULL DEFAULT CURDATE(),
    pershkrimi TEXT NOT NULL,
    afati DATE NOT NULL,
    kerkesa TEXT NOT NULL,
    user_id INT(11) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
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
if (mysqli_query($con, $sql0)) {
    echo "Tabela 'aplikimet' u krijua me sukses.<br>";
} else {
    echo "Gabim në krijimin e tabelës 'aplikimet': " . mysqli_error($con) . "<br>";
}
mysqli_close($con);

?>