<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detajet e Profesionit - Shofer</title>
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
            background: hsla(0, 0%, 100%, 0.902);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .profession-title {
            background-color:#264653;
            color:white;
            padding: 15px 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profession-details {
            position:relative;
            background-image: url('foto/Transporti_Ferizaj.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
                    loginModal.style.top = `${initialPosition.top}px`;
                    loginModal.style.left = `${initialPosition.left}px`;
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
                loginModal.style.top = `${initialPosition.top}px`;
                loginModal.style.left = `${initialPosition.left}px`;
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
                loginModal.style.top = `${y}px`;
                loginModal.style.left = `${x}px`;
            });        
        })
        .catch(err => console.error('Gabim gjat&#235 ngarkimit t&#235 header-it:', err));
    </script>
<main>
    
    <!-- Titulli Kryesor -->
    <div class="profession-title">
   <b>     Detajet e Profesionit - Shofer</b>
    </div>

    <!-- Seksioni i Detajeve -->
    <div class="profession-details"></div>

    <!-- Seksioni i Profilit -->
    <div class="profilit">
        <h1>Profili i Shoferit</h1>
        <h3>Transportimi i mallrave ose udhëtarëve në mënyrë të sigurt dhe të përgjegjshme.</h3>
    </div>

    <!-- Seksioni i Kërkesave -->
    <div class="requirements">
        <h2>Kërkesat Kryesore</h2>
        <ul class="ul">
            <li>Patentë shoferi valide e kategorisë përkatëse.</li>
            <li>Eksperiencë në drejtimin e automjeteve.</li>
            <li>Njohuri mbi mirëmbajtjen bazë të automjetit.</li>
            <li>Aftësi të mira komunikimi dhe sjellje profesionale.</li>
        </ul>
    </div>

    <!-- Seksioni i Përfitimeve -->
    <h2>Përfitimet</h2>
    <p>Duke punuar si shofer, mund të përfitoni:</p>
    <ul class="ul">
        <li>Paga konkurruese dhe bonuse.</li>
        <li>Mundësi për të udhëtuar dhe njohur vende të reja.</li>
        <li>Fleksibilitet në orarin e punës.</li>
    </ul>

 <!-- Seksioni i Aplikimit -->
 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!validateName($_POST['first-name']) ||
        !validateName($_POST['last-name']) ||
        !validateContact($_POST['phone-or-email']) ||
        ($_POST['age'] < MIN_AGE || $_POST['age'] > MAX_AGE)) {
        // Nuk vazhdon
    } else {
        require_once __DIR__ . '/Aplikimi.php';
        $aplikimi = new Aplikimi($_POST);
        header("Location: aplikimi.html");
        exit();
    }
}

// Konstanta globale
define("MIN_AGE", 18);
define("MAX_AGE", 65);

function validateName($name) {
    return preg_match("/^[A-ZÇË][a-zçë]{1,}$/u", $name);
}

function validateContact($contact) {
    $isEmail = preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/", $contact);
    $isPhone = preg_match("/^[0-9]{8,15}$/", $contact);
    return $isEmail || $isPhone;
}

function getSortedQytetet() {
    $qytetet = ["Prishtinë", "Pejë", "Podujevë", "Mitrovicë", "Fushë Kosovë", "Klinë", "Viti", "Deçan", "Gjilan", "Prizren", "Vushtrri", "Malishevë", "Drenas"];
    sort($qytetet);
    return $qytetet;
}

class Aplikimi {
    private $emri;
    private $mbiemri;
    private $kontakti;
    private $mosha;
    private $qyteti;
    private $pervoja;
    private $skills = [];

    public function __construct($data) {
        $this->emri = $data['first-name'];
        $this->mbiemri = $data['last-name'];
        $this->kontakti = $data['phone-or-email'];
        $this->mosha = (int) $data['age'];
        $this->qyteti = $data['qyteti'];
        $this->pervoja = $data['experience'] ?? 'jo';
        $this->skills = $data['skill'] ?? [];
    }

    public function getPiket() {
        return count($this->skills) * 20;
    }

    public function printTeDhenat() {
        echo "<div class='alert alert-success mt-4'>";
        echo "<h3>Të dhënat e aplikuesit:</h3>";
        echo "<ul>";
        echo "<li><strong>Emri:</strong> $this->emri</li>";
        echo "<li><strong>Mbiemri:</strong> $this->mbiemri</li>";
        echo "<li><strong>Kontakti:</strong> $this->kontakti</li>";
        echo "<li><strong>Mosha:</strong> $this->mosha</li>";
        echo "<li><strong>Qyteti:</strong> $this->qyteti</li>";
        echo "<li><strong>Përvojë:</strong> $this->pervoja</li>";
        echo "<li><strong>Pikët e përshtatshmërisë:</strong> " . $this->getPiket() . "%</li>";
        echo "</ul></div>";
    }
}

$errors = [];
$aplikimi = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!validateName($_POST['first-name'])) {
        $errors[] = "Emri duhet të fillojë me shkronjë të madhe dhe të përmbajë vetëm shkronja.";
    }

    if (!validateName($_POST['last-name'])) {
        $errors[] = "Mbiemri duhet të fillojë me shkronjë të madhe dhe të përmbajë vetëm shkronja.";
    }

    if (!validateContact($_POST['phone-or-email'])) {
        $errors[] = "Shkruani një email ose numër valid.";
    }

    if ($_POST['age'] < MIN_AGE || $_POST['age'] > MAX_AGE) {
        $errors[] = "Mosha duhet të jetë ndërmjet 18 dhe 65 vjeç.";
    }

    
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Aplikimi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4 bg-light">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($errors)) {
        echo "<div class='alert alert-danger'><ul>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul></div>";
    } elseif ($aplikimi) {
        $aplikimi->printTeDhenat();
    }
}
?>

<form id="application-form" action="" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
        <label for="first-name" class="form-label">Emri</label>
        <input type="text" name="first-name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="last-name" class="form-label">Mbiemri</label>
        <input type="text" name="last-name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="phone-or-email" class="form-label">Numri i Telefonit ose Email</label>
        <input type="text" name="phone-or-email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Mosha</label>
        <input type="number" name="age" min="18" max="65" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="qyteti" class="form-label">Zgjidh qytetin:</label>
        <input list="qyteti" name="qyteti" class="form-control">
        <datalist id="qyteti">
            <?php foreach (getSortedQytetet() as $qyteti) {
                echo "<option value='$qyteti'></option>";
            } ?>
        </datalist>
    </div>

    <div class="mb-3">
        <label class="form-label">Keni përvojë të mëparshme në këtë fushë?</label><br>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="experience" value="yes">
            <label class="form-check-label">Po</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" name="experience" value="no">
            <label class="form-check-label">Jo</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="cv" class="form-label">Ngarkoni CV-në tuaj</label>
        <input type="file" name="cv" class="form-control" accept=".pdf,.docx" required>
    </div>

    <div class="mb-3">
        <label for="cover-letter" class="form-label">Letër Motivimi</label>
        <textarea name="cover-letter" rows="5" class="form-control" placeholder="Shkruani një letër motivimi për aplikimin tuaj"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Aftësitë</label><br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="skill[]" value="1">
            <label class="form-check-label">Patenta</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="skill[]" value="2">
            <label class="form-check-label">Përvoja</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="skill[]" value="3">
            <label class="form-check-label">Njohuri mbi Sigurinë</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="skill[]" value="4">
            <label class="form-check-label">Komunikimi</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="skill[]" value="5">
            <label class="form-check-label">Puna në stres</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Apliko</button>
</form>
</body>
</html>

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

