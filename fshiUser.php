<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $username = $_POST['username_fshi'] ?? '';
    $email = $_POST['email_fshi'] ?? '';
    $password = $_POST['password_fshi'] ?? '';

    if ($user_id) {
        $stmt = $con->prepare("SELECT password FROM users WHERE id = ? AND emri_perdoruesit = ? AND email = ?");
        $stmt->bind_param("iss", $user_id, $username, $email);
        $stmt->execute();
        $stmt->bind_result($hashed);

        if ($stmt->fetch() && password_verify($password, $hashed)) {
            $stmt->close();
            $delete = $con->prepare("DELETE FROM users WHERE id = ?");
            $delete->bind_param("i", $user_id);
            if ($delete->execute()) {
                session_unset();
                session_destroy();
                echo 'sukses';
                exit;
            } else {
                echo 'gabim';
                exit;
            }
        } else {
            echo 'gabim';
        }
    } else {
        echo 'gabim';
    }
}
?>
