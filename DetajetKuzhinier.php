<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detajet e Profesionit - Kuzhinier</title>
</head>
<body>
<?php
// ------------------ PHP Bazik ------------------

// Variabla dhe var_dump()
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

var_dump($profesioni);

// Funksion me parametra dhe kthim vlere
function pershendetje($emri) {
    return "Mirë se vjen, " . ucfirst($emri) . "!";
}

// String functions
$emri = "gresa";
$pershendetje = pershendetje($emri);
echo "<p>$pershendetje</p>";

// Përdorimi i konstantave
const SHKOLLA = "Akademia e Kuzhinierëve";
echo "<p>Apliko në: " . SHKOLLA . "</p>";

// Operatorë dhe kushtet
$mosha = 25;
if ($mosha >= $moshaMin && $mosha <= $moshaMax) {
    echo "<p>Mosha është e pranueshme.</p>";
} elseif ($mosha < $moshaMin) {
    echo "<p>Mosha është nën kufirin minimal.</p>";
} else {
    echo "<p>Mosha kalon kufirin maksimal.</p>";
}

// Switch example
switch ($profesioni) {
    case "Kuzhinier":
        echo "<p>Pozita e kuzhinierit është e hapur.</p>";
        break;
    case "Kamerier":
        echo "<p>Na vjen keq, pozita nuk është aktive.</p>";
        break;
    default:
        echo "<p>Ju lutem kontrolloni sërish.</p>";
}

// Arrays: associative dhe multidimensional
$kandidatet = [
    ["emri" => "Arta", "qyteti" => "Prishtinë"],
    ["emri" => "Luan", "qyteti" => "Pejë"]
];

foreach ($kandidatet as $k) {
    echo "<p>Kandidat: " . $k['emri'] . ", Qyteti: " . $k['qyteti'] . "</p>";
}

// Sortime
asort($kerkesat);
ksort($kandidatet);
echo "<ul>";
foreach ($kerkesat as $k) {
    echo "<li>$k</li>";
}
echo "</ul>";

// ------------------ OOP PHP ------------------

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

$aplikues = new KandidatMeEksperience("gresa", 25, "Prizren", 3);
echo "<p>" . $aplikues->prezanto() . "</p>";

// ------------------ RegEx Validim ------------------

$email = "gresa@example.com";
if (preg_match("/^[\w.-]+@[\w.-]+\.\w{2,}$/", $email)) {
    echo "<p>Email i vlefshëm: $email</p>";
} else {
    echo "<p>Email i pavlefshëm</p>";
}

$numri = "+383-44-123-456";
if (preg_match("/^\+383-\d{2}-\d{3}-\d{3}$/", $numri)) {
    echo "<p>Numri i saktë: $numri</p>";
} else {
    echo "<p>Numri nuk është në formatin e duhur</p>";
}

$string = "Emri: Gresa - Pozita: Kuzhinier - Mosha: 25";
$pattern = "/Pozita: (\w+)/";
if (preg_match($pattern, $string, $matches)) {
    echo "<p>Pozita e lexuar nga string: " . $matches[1] . "</p>";
}
?>
</body>
</html>
