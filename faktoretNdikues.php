<?=session_start();?>
<?php
define("KATEGORIA_DEFAULT", "e papercaktuar");
$mesazhiFaqes = "Faktorët që ndikojnë në përzgjedhjen e karrierës";

$faktoretTituj = [
    "Interesat Personale",
    "Aftësitë dhe Shkathtësitë",
    "Vlerat dhe Besimet",
    "Shanset Ekonomike",
    "Ndikimi i Familjes",
    "Eksperiencat dhe Praktika"
];

$faktoretKategoria = [
    "Interesat Personale" => "personal",
    "Aftësitë dhe Shkathtësitë" => "profesional",
    "Vlerat dhe Besimet" => "moral",
    "Shanset Ekonomike" => "ekonomik",
    "Ndikimi i Familjes" => "social",
    "Eksperiencat dhe Praktika" => "praktik"
];

function formatFaktor($titull) {
    return ucfirst(strtolower(trim($titull)));
}

asort($faktoretTituj);


class Faktor {
    protected $titull;
    protected $kategori;

    public function __construct($titull, $kategori = KATEGORIA_DEFAULT) {
        $this->titull = $titull;
        $this->kategori = $kategori;
    }

    public function getTitull() {
        return $this->titull;
    }

    public function getKategori() {
        return $this->kategori;
    }

    public function info() {
        return "<strong>" . formatFaktor($this->titull) . "</strong> - Kategori: <em>{$this->kategori}</em>";
    }

    public function __destruct() {
        echo "<!-- Faktori '{$this->titull}' u shkatërra -->";
    }
}

class FaktorZgjeruar extends Faktor {
    private $aktiv;

    public function __construct($titull, $kategori, $aktiv = true) {
        parent::__construct($titull, $kategori);
        $this->aktiv = $aktiv;
    }

    public function eshteAktiv() {
        return $this->aktiv;
    }

    public function info() {
        $status = $this->aktiv ? "Aktiv" : "Jo aktiv";
        return parent::info() . " - Status: <span style='color: yellow;'>$status</span>";
    }
}

// Funksion për numërim të faktorëve aktiv
function numroAktivet($lista) {
    $count = 0;
    foreach ($lista as $f) {
        if ($f instanceof FaktorZgjeruar && $f->eshteAktiv()) {
            $count++;
        }
    }
    return $count;
}

$GLOBALS['numri_faktoreve'] = count($faktoretTituj);
?>

<?php include 'cookie-box.php';?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title><?php echo $mesazhiFaqes; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-thumb { background:#264653; border-radius: 10px; }
        body { font-family: Arial, sans-serif; background-color: #e6e3e3fa; margin: 0; padding: 0; }
        .container { width: 85%; margin: auto; padding: 20px; }
        h1 { color: #264653; text-align: center; margin-bottom: 30px; }
        .faktor {
            background: #264653;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .faktor:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
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
            content: "←";
            font-size: 18px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div id="header-container"></div>
    <script src="navHandler.js"></script>
   <?php include 'nav.php'; ?>

    <main class="container">
        <h1><?php echo $mesazhiFaqes; ?></h1>
        <p style="text-align:center">Totali i faktorëve: <?php echo $GLOBALS['numri_faktoreve']; ?></p>
        <?php
        foreach ($faktoretTituj as $titull) {
            $kat = $faktoretKategoria[$titull] ?? KATEGORIA_DEFAULT;
            $faktor = new FaktorZgjeruar($titull, $kat, rand(0, 1));
           // var_dump($faktor); eshte perdor per debug
            echo "<div class='faktor'>" . $faktor->info() . "</div>";
        }

        $aktiv = numroAktivet(array_map(function($t) use ($faktoretKategoria) {
            return new FaktorZgjeruar($t, $faktoretKategoria[$t] ?? KATEGORIA_DEFAULT, rand(0, 1));
        }, $faktoretTituj));

        echo "<p style='text-align:center'><em>Faktorë aktiv: $aktiv</em></p>";
        ?>
    </main>

    <!-- Shigjeta flotuese për kthim -->
    <a href="keshilla.php" class="back-btn-floating" onclick="kthehu();"></a>

    <!-- Include footer -->
    <?php include 'footer.php';?>
</body>
</html>
