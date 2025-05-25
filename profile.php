<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';
include 'nav.php';

// Kontrollo nëse përdoruesi është kyçur
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?mesazh=Ju+duhet+te+kyceni&redirect=profile.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$mesazhi = "";

// Merr të dhënat e përdoruesit nga databaza
$stmt = $con->prepare("SELECT emri, mbiemri, email, datelindja, emri_perdoruesit FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($emri, $mbiemri, $email, $datelindja, $emri_perdoruesit);
$stmt->fetch();
$stmt->close();

// Përditëso të dhënat personale
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ndrysho_te_dhenat'])) {
    $emriRi = $_POST['emri'];
    $mbiemriRi = $_POST['mbiemri'];
    $emailRi = $_POST['email'];
    $datelindjaRi = $_POST['datelindja'];
    $emriPerdoruesitRi = $_POST['emri_perdoruesit'];

    $update = $con->prepare("UPDATE users SET emri = ?, mbiemri = ?, email = ?, datelindja = ?, emri_perdoruesit = ? WHERE id = ?");
    $update->bind_param("sssssi", $emriRi, $mbiemriRi, $emailRi, $datelindjaRi, $emriPerdoruesitRi, $user_id);

    if ($update->execute()) {
        $mesazhi = "✅ Të dhënat u përditësuan me sukses.";
        $emri = $emriRi;
        $mbiemri = $mbiemriRi;
        $email = $emailRi;
        $datelindja = $datelindjaRi;
        $emri_perdoruesit = $emriPerdoruesitRi;
    } else {
        $mesazhi = "❌ Ndodhi një gabim gjatë përditësimit.";
    }
    $update->close();
}

// Ndrysho fjalëkalimin
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ndrysho_fjalekalim'])) {
    $aktual = $_POST['fjalekalimi_vjeter'];
    $ri = $_POST['fjalekalimi_ri'];
    $riKonfirmim = $_POST['fjalekalimi_ri_konfirmim'];

    if ($ri !== $riKonfirmim) {
        $mesazhi = "❌ Fjalëkalimi i ri nuk përputhet në të dy fushat.";
    } else {
        $stmt = $con->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($aktual, $hashed)) {
            $hashedNew = password_hash($ri, PASSWORD_DEFAULT);
            $updatePw = $con->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updatePw->bind_param("si", $hashedNew, $user_id);
            if ($updatePw->execute()) {
                $mesazhi = "🔒 Fjalëkalimi u ndryshua me sukses.";
            } else {
                $mesazhi = "❌ Gabim gjatë ruajtjes së fjalëkalimit.";
            }
            $updatePw->close();
        } else {
            $mesazhi = "❌ Fjalëkalimi aktual nuk është i saktë.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Profili Im</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
         ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #264653;
            border-radius: 10px;
        }
        .body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f1f1;
            margin-top: 100px;
        }

        h2 {
            text-align: center;
            color: #264653;
            margin-top: 30px;
        }

        .form {
            width: 400px;
            background-color: #fff;
            margin: 30px auto;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        form h3 {
            color: #2a9d8f;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #264653;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border 0.3s;
        }

        input:focus {
            border-color: #2a9d8f;
            outline: none;
        }

        button {
            background-color: #2a9d8f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #21867a;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 40px 0;
        }

        .mesazh {
            width: 400px;
            margin: 10px auto;
            padding: 12px 20px;
            background-color: #f4a261;
            color: white;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body class="body">
    <h2>Profili Im</h2>

    <?php if ($mesazhi) echo "<div class='mesazh'>$mesazhi</div>"; ?>

    <form class="form" method="POST">
        <h3>Të dhënat personale</h3>

        <label>Emri:</label>
        <input type="text" name="emri" value="<?= htmlspecialchars($emri) ?>" required>

        <label>Mbiemri:</label>
        <input type="text" name="mbiemri" value="<?= htmlspecialchars($mbiemri) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>

        <label>Datëlindja:</label>
        <input type="date" name="datelindja" value="<?= $datelindja ?>" required>

        <label>Emri i Përdoruesit:</label>
        <input type="text" name="emri_perdoruesit" value="<?= htmlspecialchars($emri_perdoruesit) ?>" required>

        <button type="submit" name="ndrysho_te_dhenat">Ruaj Ndryshimet</button>
    </form>

    <hr>

    <form class="form" method="POST">
        <h3>Ndrysho Fjalëkalimin</h3>

        <label>Fjalëkalimi Aktual:</label>
        <input type="password" name="fjalekalimi_vjeter" required>

        <label>Fjalëkalimi i Ri:</label>
        <input type="password" name="fjalekalimi_ri" required>

        <label>Shkruaj përsëri fjalëkalimin e ri:</label>
        <input type="password" name="fjalekalimi_ri_konfirmim" required>

        <button type="submit" name="ndrysho_fjalekalim">Ndrysho Fjalëkalimin</button>
    </form>

    <hr>

     <form class="form" method="POST" onsubmit="return confirm('A jeni të sigurt që dëshironi të fshini llogarinë tuaj? Ky veprim nuk mund të kthehet.')" id="fshiForm">
        <h3 style="color: red;">Fshi Llogarinë</h3>

        <label>Emri i përdoruesit:</label>
        <input type="text" name="username_fshi" required>

        <label>Email:</label>
        <input type="email" name="email_fshi" required>

        <label>Fjalëkalimi:</label>
        <input type="password" name="password_fshi" required>

        <button type="submit" name="fshi_llogarine" style="background-color: #e76f51;">Fshi Llogarinë</button>
    </form>

    <script>
        document.getElementById("fshiForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("fshiUser.php", {
                method: "POST",
                body: formData
            })
            .then(r => r.text())
            .then(data => {
                if (data.trim() === "sukses") {
                    alert("Llogaria u fshi me sukses.");
                    window.location.href = "index.php";
                } else {
                    alert("❌ Fshirja dështoi. Kontrollo të dhënat.");
                }
            })
            .catch(err => alert("❌ Gabim në lidhje me serverin."));
        });
</script>

    <?php include 'footer.php';?>

</body>
</html>
