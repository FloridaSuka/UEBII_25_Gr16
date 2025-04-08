<?php
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
    ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-success"><?= pershendetje($emri) ?></h4>
                <p class="card-text">Faleminderit që aplikove për pozitën: <strong><?= $profesioni ?></strong>.</p>

                <?php if ($mosha >= $moshaMin && $mosha <= $moshaMax): ?>
                    <p class="text-success">Mosha është e pranueshme.</p>
                <?php else: ?>
                    <p class="text-danger">Mosha nuk është e pranueshme!</p>
                <?php endif; ?>

                <p><?= $aplikues->prezanto() ?></p>

                <?php if (filter_var($emailOseTel, FILTER_VALIDATE_EMAIL)): ?>
                    <p>Email i vlefshëm: <strong><?= $emailOseTel ?></strong></p>
                <?php elseif (preg_match("/^\+383-\d{2}-\d{3}-\d{3}$/", $emailOseTel)): ?>
                    <p>Numri i telefonit i vlefshëm: <strong><?= $emailOseTel ?></strong></p>
                <?php else: ?>
                    <p class="text-danger">Email ose numër jo valid!</p>
                <?php endif; ?>

                <h5 class="mt-4">Kërkesat për pozitën:</h5>
                <ul>
                    <?php 
                    asort($kerkesat);
                    foreach ($kerkesat as $k): ?>
                        <li><?= $k ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if (!empty($motivimi)): ?>
                    <div class="mt-3">
                        <strong>Letra motivuese:</strong>
                        <p><?= nl2br(htmlspecialchars($motivimi)) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    $output = ob_get_clean();
}
?>
<?php if (isset($output)) echo $output; ?>
