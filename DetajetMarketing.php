
< ?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST['first-name'];
    $mbiemri = $_POST['last-name'];
    $emailOseTel = $_POST['phone-or-email'];
    $mosha = $_POST['age'];
    $qyteti = $_POST['qyteti'];
    $eksperienca = $_POST['experience'] ?? 'Jo';
    $motivimi = $_POST['cover-letter'];

    $profesioni = "Specialist Marketingu";
    $moshaMin = 18;
    $moshaMax = 65;
    $kerkesat = [
        "Diplomë në marketing",
        "Përvojë në reklamim",
        "Njohuri të mjeteve digjitale",
        "Aftësi analitike",
        "Punë në ekip"
    ];

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

        public function getMosha() {
            return $this->mosha;
        }

        public function getQyteti() {
            return $this->qyteti;
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
    echo "<div style='background:#dff0d8; padding:15px; border-radius:10px; margin-top:30px;'>";
    echo "<p>" . pershendetje($emri) . "</p>";
    echo "<p>Faleminderit që aplikove për pozitën: <b>$profesioni</b>.</p>";

    if ($mosha >= $moshaMin && $mosha <= $moshaMax) {
        echo "<p>Mosha është e pranueshme.</p>";
    } else {
        echo "<p style='color:red;'>Mosha nuk është e pranueshme!</p>";
    }

    echo "<p>" . $aplikues->prezanto() . "</p>";

    if (filter_var($emailOseTel, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Email i vlefshëm: $emailOseTel</p>";
    } elseif (preg_match("/^\+383-\d{2}-\d{3}-\d{3}$/", $emailOseTel)) {
        echo "<p>Numri i telefonit i vlefshëm: $emailOseTel</p>";
    } else {
        echo "<p style='color:red;'>Email ose numër jo valid!</p>";
    }

    echo "<p><b>Kërkesat për pozitën:</b></p><ul>";
    asort($kerkesat);
    foreach ($kerkesat as $k) {
        echo "<li>$k</li>";
    }
    echo "</ul>";

    if (!empty($motivimi)) {
        echo "<p><b>Letra motivuese:</b><br>$motivimi</p>";
    }

    echo "</div>";
    $output = ob_get_clean();
}
?>
<!-- Pjesa tjetër e HTML që ti e ke do vendoset këtu kur bashkohet -->
<?php if (isset($output)) echo $output; ?>
