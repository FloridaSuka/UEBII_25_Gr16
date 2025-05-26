<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';
require 'php_mailer/src/Exception.php';
require 'db.php';

session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri_perdoruesit = filter_var($_POST['emri_perdoruesit'] ?? '', FILTER_SANITIZE_STRING);
    $email            = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);

    if (empty($emri_perdoruesit) || empty($email)) {
        echo json_encode(["status" => "error", "message" => "Të gjitha fushat janë të detyrueshme."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Email i pavlefshëm."]);
        exit;
    }

    // Kontrollo nëse përdoruesi ekziston në databazë
    $stmt = $con->prepare("SELECT * FROM users WHERE emri_perdoruesit = ? AND email = ?");
    $stmt->bind_param("ss", $emri_perdoruesit, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        echo json_encode(["status" => "error", "message" => "Ky kombinim i përdoruesit dhe emailit nuk ekziston."]);
        exit;
    }

    // Gjenero kodin
    $verificationCode = rand(100000, 999999);
    $_SESSION['reset_kodi'] = $verificationCode;
    $_SESSION['reset_email'] = $email;

    $mail = new PHPMailer(true);

   try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'findyourway.2024.25@gmail.com';
    $mail->Password   = 'obszazgpwveinsmz';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom('findyourway.2024.25@gmail.com', 'FindYourWay');
    $mail->addAddress($email, $emri_perdoruesit);

    $mail->isHTML(true);
    $mail->Subject = 'Kodi i Verifikimit - FindYourWay';
    $mail->Body    = "
        <p>Përshëndetje <strong>$emri_perdoruesit</strong>,</p>
        <p>Kodi juaj për verifikim është: <strong style='font-size: 20px;'>$verificationCode</strong></p>
        <p>Shënoje këtë kod për të vazhduar me ndryshimin e fjalëkalimit.</p>
        <br><em>Ky email është automatik - mos u përgjigj.</em>";

    if (!$mail->send()) {
        throw new Exception("Dërgimi i emailit dështoi: " . $mail->ErrorInfo);
    }

    //Ruajtja e kodit në një fajll log
    $folder = __DIR__ . "/logs";
    if (!file_exists($folder)) {
        if (!mkdir($folder, 0777, true)) {
            throw new Exception("Dështoi krijimi i folderit për log.");
        }
    }

    $filepath = $folder . "/kodet_verifikimit.txt";
    $logLine = "Username: $emri_perdoruesit | Email: $email | Kodi: $verificationCode | Koha: " . date("Y-m-d H:i:s") . PHP_EOL;

    if (!file_put_contents($filepath, $logLine, FILE_APPEND)) {
        throw new Exception("Dështoi shkrimi i kodit në fajll.");
    }

    echo json_encode(["status" => "success", "message" => "Kodi u dërgua me sukses! Kontrolloni emailin tuaj."]);

} catch (Exception $e) {
    // Trajto gabimin në mënyrë të personalizuar
    echo json_encode(["status" => "error", "message" => "Gabim: " . $e->getMessage()]);
}
}