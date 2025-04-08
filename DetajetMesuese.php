<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detajet e Profesionit - Mësuese</title>
    <style>
         ::-webkit-scrollbar{
        width: 10px;
        }
        ::-webkit-scrollbar-track{
        
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb{
            background:#264653;
            border-radius: 10px;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eef2f3;
            color: #333;
            line-height: 1.6;
        }

        main {
            padding: 20px;
            max-width: 900px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .profession-title {
            background-color: #264653;
            color: white;
            padding: 15px 20px;
            text-align:center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profession-details {
            position: relative;
            background-image: url('foto/Shkolla e Mesme Alpbach.jpg'); /* Ndryshoni për foton e mësuese */
            background-size: cover;
            background-position: center;
            background-repeat:no-repeat;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        .profession-details .info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(38, 70, 83, 0.8);
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            text-align: left;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .requirements {
            margin-top: 20px;
            padding: 20px;
            border-top: 1px solid #264653;
        }

        h2 {
            color: #264653;
            margin-bottom: 15px;
        }

        .ul {
            padding-left: 20px;
            list-style: none;
        }

        .ul li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .ul li::before {
            content: "";
            width: 10px;
            height: 10px;
            background-color: #264653;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: #21867a;
            transform: scale(1.05);
        }

        .image-section {
            margin-top: 20px;
            text-align: center;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: #21867a;
            transform: scale(1.05);
        }

        .form-section {
            margin-top: 40px;
            background-color: hwb(210 97% 0%);
            padding: 20px;
            border-radius: 10px;
            color: #333;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .form-section label {
            
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-section .input, .form-section textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-section button {
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #21867a;
        }

        /* Shigjetë për butonin Apliko Tani dhe butonin për kthim */
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
        }

        .back-btn:hover {
            background-color: #21867a;
            transform: scale(1.05);
        }

        .back-btn::before {
            content: "←"; /* Shigjeta e kthimit */
            font-size: 18px;
        }

        /* Shigjeta flotuese në cepin e djathtë të faqes */
        .back-btn-floating {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .back-btn-floating:hover {
            background-color: #21867a;
            transform: scale(1.05);
        }

        .back-btn-floating::before {
            content: "←"; /* Shigjeta e kthimit */
            font-size: 18px;
        }
    </style>
    <script>
        function calculateMatch() {
            const totalSkills = 5; // Numri total i aftësive të kërkuara
            const selectedSkills = document.querySelectorAll('input[type="checkbox"]:checked').length;
            const matchPercentage = (selectedSkills / totalSkills) * 100;
            document.getElementById('matchOutput').value = matchPercentage.toFixed(0) + "%";
        }
    </script>
</head>
<body>
   <!-- importo file te html per nav ne div -->

   <div id="header-container"></div>
   <script>
    // JavaScript për të ngarkuar header-in nga file-i i jashtëm
    fetch('nav.html')
    .then(response => response.text())
    .then(data => {
        // Vendos përmbajtjen e header-it në div-in me id="header-container"
        document.getElementById('header-container').innerHTML = data;
        // Lidh eventet pasi përmbajtja të jetë ngarkuar
        const loginIcon = document.getElementById('loginIcon');
        const loginModal = document.getElementById('loginModal');
        const closeBtn = document.getElementById('closeBtn');
        const initialPosition = { top: 50, left: 50 }; // Pozita fillestare e modalit

        //hap modalin
        if (loginIcon) {
            loginIcon.addEventListener('click', () => {
                loginModal.style.display = 'block';
                loginModal.style.top = ${initialPosition.top}px;
                loginModal.style.left = ${initialPosition.left}px;
            });
        }
        //mbyll modalin
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                loginModal.style.display = 'none';
            });
        }
       // Kthimi i modalit në pozitën fillestare
        loginModal.addEventListener('dblclick', () => {
            loginModal.style.top = ${initialPosition.top}px;
            loginModal.style.left = ${initialPosition.left}px;
        });
        //mbyllja kur klikohet jasht modalit
        window.addEventListener('click', (e) => {
            if (e.target === loginModal) {
                loginModal.style.display = 'none';
            }
        });
        // Drag and drop
        let offsetX = 0, offsetY = 0;

        loginModal.addEventListener('dragstart', (e) => {
            const rect = loginModal.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;
        });

        document.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        document.addEventListener('drop', (e) => {
            e.preventDefault();
            const x = e.clientX - offsetX;
            const y = e.clientY - offsetY;
            loginModal.style.top = ${y}px;
            loginModal.style.left = ${x}px;
        });        
    })
    .catch(err => console.error('Gabim gjat&#235 ngarkimit t&#235 header-it:', err));
</script>
<main>
    <!-- Titulli Kryesor -->
    <div class="profession-title">
      <b>  Detajet e Profesionit - Mësuese</b>
    </div>

    <!-- Seksioni i Detajeve -->
    <div class="profession-details">
        <!-- Nuk është nevoja për seksionin e fotos më vete pasi është background i seksionit -->
    </div>

    <!-- Seksioni i Profilit -->
    <div class="profilit">
        <h1>
            Profili i Mësueses
        </h1>
        <h3>
            Mësimi dhe udhëzimi i studentëve në përvetësimin e njohurive dhe zhvillimin e aftësive.
        </h3>
    </div>

    <!-- Seksioni i Kërkesave -->
    <div class="requirements">
        <h2>Kërkesat Kryesore</h2>
        <ul class="ul">
            <li>Diplomë e lartë në fushën përkatëse (p.sh., edukim, shkenca, letërsi, etj.).</li>
            <li>Eksperiencë mësimdhënieje ose praktika mësimore.</li>
            <li>Aftësi të shkëlqyera komunikimi dhe udhëheqjeje të klasës.</li>
            <li>Njohuri të forta të metodologjisë mësimore dhe përdorimi i mjeteve edukative.</li>
        </ul>
    </div>

    <!-- Seksioni i Përfitimeve -->
    <h2>Përfitimet</h2>
    <p>
        Duke punuar si mësuese, mund të përfitoni:
    </p>
    <ul class="ul">
        <li>Stabilitet profesional dhe mundësi për zhvillim të vazhdueshëm.</li>
        <li>Pushime verore dhe periudha të tjera pushimi.</li>
        <li>Fleksibilitet në orarin e punës dhe mundësi për krijimin e materiale mësimore kreative.</li>
    </ul>
    
    <?php
ob_start(); // Aktivizo buffering per te shmangur gabimin me header()
error_reporting(E_ALL);
ini_set('display_errors', 1);

$output = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST['first-name'];
    $mbiemri = $_POST['last-name'];
    $emailOseTel = $_POST['phone-or-email'];
    $mosha = $_POST['age'];
    $qyteti = $_POST['qyteti'];
    $eksperienca = $_POST['experience'] ?? 'Jo';
    $motivimi = $_POST['cover-letter'];

    $profesioni = "Mësuese";
    $moshaMin = 18;
    $moshaMax = 65;

    if (empty($emri) || empty($mbiemri) || empty($emailOseTel) || empty($mosha) || empty($qyteti)) {
        $errors[] = "Ju lutemi plotësoni të gjitha fushat e detyrueshme.";
    }

    if (!filter_var($emailOseTel, FILTER_VALIDATE_EMAIL) && !preg_match("/^\\+383-\\d{2}-\\d{3}-\\d{3}$/", $emailOseTel)) {
        $errors[] = "Email ose numër telefoni jo valid. (Shkruani email me '@' ose numër si +383-44-123-123)";
    }

    if ($mosha < $moshaMin || $mosha > $moshaMax) {
        $errors[] = "Mosha duhet të jetë ndërmjet $moshaMin dhe $moshaMax vjeç.";
    }

    if (empty($errors)) {
        header("Location: aplikimi.html");
        exit();
    }

    function pershendetje($emri) {
        return "Mirë se vjen, " . ucfirst($emri) . "!";
    }

    class Kandidat {
        private $emri;
        private $mbiemri;
        private $mosha;
        protected $qyteti;

        public function __construct($emri, $mbiemri, $mosha, $qyteti) {
            $this->emri = $emri;
            $this->mbiemri = $mbiemri;
            $this->mosha = $mosha;
            $this->qyteti = $qyteti;
        }

        public function getEmri() {
            return ucfirst($this->emri) . ' ' . ucfirst($this->mbiemri);
        }

        public function prezanto() {
            return "Unë jam " . $this->getEmri() . ", " . $this->mosha . " vjeç, nga " . $this->qyteti . ".";
        }
    }

    class KandidatMeEksperience extends Kandidat {
        public $viteEksperience;

        public function __construct($emri, $mbiemri, $mosha, $qyteti, $viteEksperience) {
            parent::__construct($emri, $mbiemri, $mosha, $qyteti);
            $this->viteEksperience = $viteEksperience;
        }

        public function prezanto() {
            return parent::prezanto() . " Kam " . $this->viteEksperience . " vite përvojë.";
        }
    }

    $vite = $eksperienca == "yes" ? 3 : 0;
    $aplikues = new KandidatMeEksperience($emri, $mbiemri, $mosha, $qyteti, $vite);

    ob_start();
    ?>
    <div class="container mt-4">
        <div class="alert alert-danger">
            <h5>Gabime gjatë aplikimit:</h5>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-success"><?php echo pershendetje($emri); ?></h4>
                <p class="card-text">Informacioni i dhënë:</p>
                <p><?php echo $aplikues->prezanto(); ?></p>
                <p>Email ose Tel: <strong><?php echo htmlspecialchars($emailOseTel); ?></strong></p>
                <?php if (!empty($motivimi)): ?>
                    <p><strong>Letra motivuese:</strong><br><?php echo nl2br(htmlspecialchars($motivimi)); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    $output = ob_get_clean();
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Aplikimi për Mësuese</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Aplikoni për Pozitën e Mësueses</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label>Emri:</label>
                <input type="text" name="first-name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mbiemri:</label>
                <input type="text" name="last-name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email ose Telefon (+383-44-123-123):</label>
                <input type="text" name="phone-or-email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mosha:</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Qyteti:</label>
                <input type="text" name="qyteti" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Eksperiencë në këtë fushë?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="experience" value="yes">
                    <label class="form-check-label">Po</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="experience" value="no">
                    <label class="form-check-label">Jo</label>
                </div>
            </div>
            <div class="mb-3">
                <label>Letër motivuese:</label>
                <textarea name="cover-letter" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Dërgo</button>
        </form>

        <!-- Outputi nëse ka gabime -->
        <?php if (!empty($output)) echo $output; ?>
    </div>
</body>
</html>

<?php ob_end_flush(); ?>


<style>
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
</style>


   
</main>
<!-- Shigjeta flotuese për kthim -->
<a href="#" class="back-btn-floating" onclick="shkoTeFaqja();"></a>


<div id="footer-container"></div>
<script>
    // JavaScript për ngarkimin e footer-it nga file-i i jashtëm
    fetch('footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer-container').innerHTML = data;
        })
        .catch(err => console.error('Gabim gjatë ngarkimit të footer-it:', err));

    // Funksioni për navigim te faqja e re
    function shkoTeFaqja() {
        window.location.href = "shpalljet.html"; // Këtu vendos destinacionin tënd
    }
</script>
<script src="loginPopup.js"></script>
</body>
</html>