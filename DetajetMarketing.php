<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$output = '';

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
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-success"><?php echo pershendetje($emri); ?></h4>
                <p class="card-text">Faleminderit që aplikove për pozitën: <strong><?php echo $profesioni; ?></strong>.</p>

                <?php if ($mosha >= $moshaMin && $mosha <= $moshaMax): ?>
                    <p class="text-success">Mosha është e pranueshme.</p>
                <?php else: ?>
                    <p class="text-danger">Mosha nuk është e pranueshme!</p>
                <?php endif; ?>

                <p><?php echo $aplikues->prezanto(); ?></p>

                <?php if (filter_var($emailOseTel, FILTER_VALIDATE_EMAIL)): ?>
                    <p>Email i vlefshëm: <strong><?php echo $emailOseTel; ?></strong></p>
                <?php elseif (preg_match("/^\+383-\d{2}-\d{3}-\d{3}$/", $emailOseTel)): ?>
                    <p>Numri i telefonit i vlefshëm: <strong><?php echo $emailOseTel; ?></strong></p>
                <?php else: ?>
                    <p class="text-danger">Email ose numër jo valid!</p>
                <?php endif; ?>

                <h5 class="mt-4">Kërkesat për pozitën:</h5>
                <ul>
                    <?php 
                    asort($kerkesat);
                    foreach ($kerkesat as $k): ?>
                        <li><?php echo $k; ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if (!empty($motivimi)): ?>
                    <div class="mt-3">
                        <strong>Letra motivuese:</strong>
                        <p><?php echo nl2br(htmlspecialchars($motivimi)); ?></p>
                    </div>
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
    <title>Forma e Aplikimit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Aplikoni për Pozitën</h2>
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
    </div>

    <!-- Outputi pas submit -->
    <?php if (!empty($output)) echo $output; ?>
</body>
</html>
