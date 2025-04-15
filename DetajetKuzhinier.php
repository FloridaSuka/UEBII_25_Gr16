<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detajet e Profesionit - Kuzhinier</title>
    <style>
        body { font-family: Arial; line-height: 1.6; padding: 20px; }
        input, label { display: block; margin: 10px 0; }
    </style>
</head>
<body>
<div id="header-container"></div>
    <script src="navHandler.js"></script>
    <script>
        fetch('nav.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-container').innerHTML = data;
                setupNavigation(); // Funksioni nga navHandler.js
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
            .catch(err => console.error('Gabim gjatë ngarkimit të header-it:', err));
    </script>
<h2>Aplikim për pozitën Kuzhinier</h2>

<!-- Forma që qëndron në të njëjtën faqe -->
<form method="post" action="">
    <label for="emri">Emri:</label>
    <input type="text" name="emri" required>

    <label for="telefoni">Numri i telefonit:</label>
    <input type="text" name="telefoni" id="telefoni" 
           placeholder="+383-44-123-456" required
           pattern="\+383-\d{2}-\d{3}-\d{3}"
           onkeypress="return vetemTastetELejueshme(event)">

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <input type="submit" name="apliko" value="Apliko">
</form>

<!-- JavaScript: lejon vetëm numra, + dhe - -->
<script>
function vetemTastetELejueshme(e) {
    const lejuar = /[0-9+\-]/;
    const tast = String.fromCharCode(e.which);
    if (!lejuar.test(tast)) {
        e.preventDefault();
        return false;
    }
    return true;
}
</script>

<?php
if (isset($_POST['apliko'])) {

    $profesioni = "Kuzhinier";
    $moshaMin = 18;
    $moshaMax = 65;
    $kerkesat = [
        "Eksperiencë në gatim",
        "Aftësi në grup",
        "Njohuri të higjenës",
        "Menaxhim kohe",
        "Punë në presion"
    ];

    $emri = $_POST['emri'];
    $email = $_POST['email'];
    $telefoni = $_POST['telefoni'];

    function pershendetje($emri) {
        return "Mirë se vjen, " . ucfirst($emri) . "!";
    }

    echo "<p>" . pershendetje($emri) . "</p>";
    echo "<p>Apliko në: Akademia e Kuzhinierëve</p>";

    $mosha = 25;
    if ($mosha >= $moshaMin && $mosha <= $moshaMax) {
        echo "<p>Mosha është e pranueshme.</p>";
    } else {
        echo "<p>Mosha nuk është e pranueshme.</p>";
    }

    switch ($profesioni) {
        case "Kuzhinier":
            echo "<p>Pozita e kuzhinierit është e hapur.</p>";
            break;
        default:
            echo "<p>Ju lutem kontrolloni sërish.</p>";
    }

    asort($kerkesat);
    echo "<p>Kërkesat:</p><ul>";
    foreach ($kerkesat as $k) {
        echo "<li>$k</li>";
    }
    echo "</ul>";

    class Kandidat {
        private $emri;
        private $mosha;
        protected $qyteti;

        public function __construct($emri, $mosha, $qyteti) {
            $this->emri = $emri;
            $this->mosha = $mosha;
            $this->qyteti = $qyteti;
        }

        public function getEmri() {
            return ucfirst($this->emri);
        }

        public function getMosha() {
            return $this->mosha;
        }

        public function setQyteti($qyteti) {
            $this->qyteti = $qyteti;
        }

        public function getQyteti() {
            return $this->qyteti;
        }

        public function prezanto() {
            return "Unë jam " . $this->getEmri() . ", jam " . $this->getMosha() . " vjeç dhe vij nga " . $this->getQyteti() . ".";
        }

        public function __destruct() {
            echo "<p>Destruktori u thirr për " . $this->getEmri() . "</p>";
        }
    }

    class KandidatMeEksperience extends Kandidat {
        public $viteEksperience;

        public function __construct($emri, $mosha, $qyteti, $viteEksperience) {
            parent::__construct($emri, $mosha, $qyteti);
            $this->viteEksperience = $viteEksperience;
        }

        public function prezanto() {
            return parent::prezanto() . " Kam " . $this->viteEksperience . " vite eksperiencë.";
        }
    }

    $aplikues = new KandidatMeEksperience($emri, $mosha, "Prizren", 3);
    echo "<p>" . $aplikues->prezanto() . "</p>";

    if (preg_match("/^[\w.-]+@[\w.-]+\.\w{2,}$/", $email)) {
        echo "<p>Email i vlefshëm: $email</p>";
    } else {
        echo "<p>Email i pavlefshëm</p>";
    }

    if (preg_match("/^\+383-\d{2}-\d{3}-\d{3}$/", $telefoni)) {
        echo "<p>Numri i saktë: $telefoni</p>";
    } else {
        echo "<p>Numri nuk është në formatin e duhur</p>";
    }

    $string = "Emri: $emri - Pozita: Kuzhinier - Mosha: $mosha";
    $pattern = "/Pozita: (\w+)/";
    if (preg_match($pattern, $string, $matches)) {
        echo "<p>Pozita e lexuar nga string: " . $matches[1] . "</p>";
    }
}
?>

</body>
</html>
