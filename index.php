<!-- Ueb2 -->
<?php
// Definimi i klasës Perdorues
class Perdorues {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function login() {
        if ($this->username === "admin" && $this->password === "1234") {
            return "Mirë se vjen, admin!";
        } else {
            return "Kredencialet janë të gabuara.";
        }
    }

    public function register() {
        return "Regjistrimi i suksesshëm për përdoruesin: $this->username";
    }
}

// Përpunimi i formës
$mesazhi = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formType = $_POST["form_type"] ?? "";

    if ($formType === "login") {
        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        // Validim i thjeshtë
        if (!preg_match("/^[a-zA-Z0-9]{3,20}$/", $username)) {
            $mesazhi = "Emri i përdoruesit është i pavlefshëm!";
        } else {
            $perdorues = new Perdorues($username, $password);
            $mesazhi = $perdorues->login();
        }
    }

    if ($formType === "register") {
        $username = $_POST["register_username"] ?? "";
        $password = $_POST["register_password"] ?? "";

        if (!preg_match("/^[a-zA-Z0-9]{3,20}$/", $username)) {
            $mesazhi = "Emri i përdoruesit është i pavlefshëm për regjistrim!";
        } else {
            $perdorues = new Perdorues($username, $password);
            $mesazhi = $perdorues->register();
        }
    }
}
?>
<!-- Ueb2 -->

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="faqjakryesore.css">
</head>
<body>
    <img src="foto/logo.svg" alt="Logo" class="logo">
    <p class="show">Mirë se erdhe, <br> shpresojmë të gjeni atë që po kërkoni.</p>
    <a href="home.html" class="return-link">Vazhdo pa u kyçur</a>

    <?php if (!empty($mesazhi)): ?>
        <p style="color: red; font-weight: bold;"><?php echo $mesazhi; ?></p>
    <?php endif; ?>

    <div class="login">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Hyr</button>
                <button type="button" class="toggle-btn" onclick="register()">Regjistrohu</button>
            </div>

            <!-- Forma për Hyrje -->
            <form id="login" class="input-group" method="post">
                <input type="hidden" name="form_type" value="login">
                <input type="text" class="input-field" name="username" placeholder="Emri i përdoruesit" required>
                <input type="password" class="input-field" name="password" placeholder="Fjalëkalimi" required>
                <input type="checkbox" class="check-box"><span>Kujto Fjalëkalimin</span> 
                <label class="button"><a href="login.php">Keni harruar fjalëkalimin?</a></label>
                <button type="submit" class="submit-btn">Hyr</button>
            </form>

            <!-- Forma për Regjistrim -->
            <form id="register" class="input-group" method="post">
                <input type="hidden" name="form_type" value="register">
                <input type="text" class="input-field" placeholder="Emri" required>
                <input type="text" class="input-field" placeholder="Mbiemri" required>
                <input type="text" class="input-field" name="register_username" placeholder="Emri Përdoruesit" required>
                <input type="email" class="input-field" placeholder="Email" required>
                <input type="password" class="input-field" name="register_password" placeholder="Fjalëkalimi" required>
                <input type="checkbox" class="check-box"><span>Jam dakord me termat dhe kushtet</span> 
                <button type="submit" class="submit-btn">Regjistrohu</button>
            </form>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
