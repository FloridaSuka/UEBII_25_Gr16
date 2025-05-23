<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';
require 'php_mailer/src/Exception.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri    = filter_var($_POST['first-name'] ?? '', FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['phone-or-email'] ?? '', FILTER_SANITIZE_EMAIL);    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Email i pavlefshëm."]);
        exit;
    }

    $mail2 = new PHPMailer(true);

    try {
            $mail2->isSMTP();
            $mail2->Host       = 'smtp.gmail.com';
            $mail2->SMTPAuth   = true;
            $mail2->Username   = 'findyourway.2024.25@gmail.com';
            $mail2->Password   = 'obszazgpwveinsmz'; // <-- saktë, pa hapësira!
            $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail2->Port       = 587;
            $mail2->CharSet = 'UTF-8';


            $mail2->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

        // Emaili nga ti te përdoruesi
        $mail2->setFrom('findyourway.2024.25@gmail.com', 'FindYourWay');
        $mail2->addAddress($email, $emri);
        $mail2->isHTML(true);
        $mail2->Subject = 'Faleminderit per aplikimin tuaj!';
        $mail2->Body    = "Përshëndetje $emri,<br><br>Faleminderit per aplikimin tuaj. Aplikimi juaj është pranuar dhe do të trajtohet sa më shpejt.<br><br><em>Ky është një email automatik, ju lutem mos u përgjigjni.</em>";

        $mail2->send();

        echo json_encode(["status" => "success", "message" => "Mesazhi u dërgua me sukses!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Gabim gjatë dërgimit: {$e->getMessage()}"]);
    }
}
?>
