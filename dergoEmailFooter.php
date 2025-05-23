<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';
require 'php_mailer/src/Exception.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri    = filter_var($_POST['emri'] ?? '', FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);    
    $mesazhi = filter_var($_POST['mesazhi'] ?? '', FILTER_SANITIZE_STRING);


    if (empty($emri) || empty($email) || empty($mesazhi)) {
        echo json_encode(["status" => "error", "message" => "Të gjitha fushat janë të detyrueshme."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Email i pavlefshëm."]);
        exit;
    }

    $mail1 = new PHPMailer(true);
    $mail2 = new PHPMailer(true);

    try {
        foreach ([$mail1, $mail2] as $mail) {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'findyourway.2024.25@gmail.com';
            $mail->Password   = 'obszazgpwveinsmz'; // <-- saktë, pa hapësira!
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet = 'UTF-8';


            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
        }

        // Emaili nga useri te ti
        $mail1->setFrom($email, $emri);
        $mail1->addAddress('findyourway.2024.25@gmail.com');
        $mail1->isHTML(true);
        $mail1->Subject = 'Mesazh nga forma e kontaktit';
        $mail1->Body    = "<strong>Emri:</strong> $emri<br><strong>Email:</strong> $email<br><strong>Mesazhi:</strong><br>$mesazhi";

        // Emaili nga ti te përdoruesi
        $mail2->setFrom('findyourway.2024.25@gmail.com', 'FindYourWay');
        $mail2->addAddress($email, $emri);
        $mail2->isHTML(true);
        $mail2->Subject = 'Faleminderit që na kontaktuat!';
        $mail2->Body    = "Përshëndetje $emri,<br><br>Faleminderit që na kontaktuat. Mesazhi juaj është pranuar dhe do të trajtohet sa më shpejt.<br><br><em>Ky është një email automatik, ju lutem mos u përgjigjni.</em>";

        $mail1->send();
        $mail2->send();

        echo json_encode(["status" => "success", "message" => "Mesazhi u dërgua me sukses!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Gabim gjatë dërgimit: {$e->getMessage()}"]);
    }
}
?>
