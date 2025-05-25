<?php
define("TEMA", "Zhvillimi Profesional");
$mesazhiFaqes = "Cilat janë disa nga mundësitë për zhvillim profesional?";

$mundesite = [
    "Kurse dhe Trajnime" => "Pjesëmarrje në kurse që forcojnë aftësitë teknike e personale. ✅ Këshillë: Zgjidh kurset sipas qëllimeve të tua.",
    "Arsimimi i Mëtejshëm" => "Studime master/doktoraturë për avancim akademik. 🎓 Këshillë: Fokusohu në fushat e kërkuara.",
    "Mentorimi dhe Këshillimi" => "Mëso nga ekspertë përmes mentorimit të personalizuar. 💬 Këshillë: Kërko mentorë në rrjetin tënd profesional.",
    "Konferenca dhe Seminare" => "Ngjarje që nxisin rrjetëzimin dhe ide të reja. 🧠 Këshillë: Përdor seminaret për të ndërtuar kontakte.",
    "Puna Vullnetare" => "Kontribuo dhe rrit aftësitë në të njëjtën kohë. 🤝 Këshillë: Zgjidh organizata që lidhen me interesat tuaja.",
    "Internshipe të Paguar" => "Përvojë praktike me pagesë për studentë dhe të diplomuar. 💼 Këshillë: Apliko në kompani me perspektivë.",
    "Certifikime Online" => "Kurset me certifikata që rrisin kredibilitetin tënd. 🌐 Këshillë: Fokusohu në platforma të njohura si Coursera, Udemy.",
    "Përfshirje në Projekte" => "Merr pjesë në projekte për të mësuar ‘hands-on’. 🛠️ Këshillë: Bashkohu me ekipe vullnetare ose startup-e.",
    "Ndjekja e Webinarëve" => "Webinarët ofrojnë njohuri nga ekspertët globalë. 🎥 Këshillë: Ndiq tematikat që përputhen me karrierën.",
    "Leximi i Literatures Profesionale" => "Rrit dijen me libra e artikuj profesional. 📚 Këshillë: Le të bëhet zakon mujor leximi i një libri.",
    "Rrjetëzim Profesional" => "Ndërto lidhje që sjellin mundësi të reja. 🔗 Këshillë: Përdor LinkedIn për të ndjekur liderët e fushës.",
    "Angazhim në Startup-e" => "Zhvillim në ambient dinamik dhe inovativ. 🚀 Këshillë: Eksploro mundësi në startup-e lokale.",
    "Aplikime për Grante" => "Fitoni fonde për idetë dhe iniciativat tuaja. 💰 Këshillë: Planifiko mirë dhe aplikoni herët.",
    "Pjesëmarrje në Garëra Inovative" => "Hackathonë dhe konkurse që sfidojnë mendjen. 🧩 Këshillë: Bashkohu me ekipe të ndryshme për eksperiencë.",
    "Konsultime me Karrierë Coach" => "Plani yt i karrierës me ndihmën e një profesionisti. 🎯 Këshillë: Mos prit sfida për të kërkuar ndihmë.",
    "Mësim në Distancë" => "Mëso nga shtëpia pa kufizime fizike. 🖥️ Këshillë: Krijo orar të rregullt për mësim.",
    "Shoqata Profesionale" => "Angazhohu në organizata të profesionit tënd. 🏛️ Këshillë: Apliko për anëtarësim dhe merr pjesë në evente.",
    "Ndjekje Kursi në LinkedIn" => "Kurset më të përditësuara për karrierë. 🔍 Këshillë: Përditëso profilin pas çdo certifikimi.",
    "Eksperienca Ndërkombëtare" => "Zgjero horizontin përmes mobilitetit. ✈️ Këshillë: Apliko në programe si Erasmus+, AIESEC.",
    "Hackathone dhe Projekte Inovative" => "Gara krijuese për të shfaqur aftësitë tuaja. ⚙️ Këshillë: Zgjidh sfida të lidhura me pasionin tënd.",
    "Artikuj Profesional" => "Shkruaj për tema që njeh – për të ndarë dhe mësuar. ✍️ Këshillë: Filloni një blog ose publikoni në Medium.",
    "Shërbime në Komunitet" => "Ndihmo të tjerët dhe zhvillo empatinë. 🤗 Këshillë: Angazhohu në projekte lokale të rinisë.",
    "Self learning" => "Rruga më fleksibile për zhvillim personal. 🧘 Këshillë: Shfrytëzo YouTube dhe podcast-et.",
    "Zhvillimi i Aftësive Drejtuese" => "Rritja e kompetencave për menaxhim. 📈 Këshillë: Filloni duke udhëhequr projekte të vogla."
];

function emriFotos($titull) {
    $emri = strtolower(str_replace(["ë", " "], ["e", "-"], $titull));
    return "$emri.jpg";
}

ksort($mundesite);

class Mundesi {
    private $titull;
    private $pershkrim;
    private $foto;

    public function __construct($titull, $pershkrim, $foto) {
        $this->titull = $titull;
        $this->pershkrim = $pershkrim;
        $this->foto = $foto;
    }

    public function shfaq() {
        return "
        <div class='col-md-6 col-lg-4 mb-4 item'>
            <div class='card shadow-sm h-100'>
                <img class='card-img-top' src='foto/{$this->foto}' alt='{$this->titull}' height='180' style='object-fit: cover'>
                <div class='card-body'>
                    <h5 class='card-title'>{$this->titull}</h5>
                    <p class='card-text'>{$this->pershkrim}</p>
                </div>
            </div>
        </div>";
    }
}

$koment = (count($mundesite) >= 20) ? "🧠 Ke shumë mundësi për të ndërtuar karrierën tënde!" : "Zgjedhjet janë të pakta – eksploro më shumë!";
?>

<?php include 'cookie-box.php';?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title><?= TEMA ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
         ::-webkit-scrollbar { width: 10px; }
         ::-webkit-scrollbar-thumb { background:#264653; border-radius: 10px; }
        body { background: #f4f6f9; font-family: Arial, sans-serif; }
        h1 { color: #264653; text-align: center; margin: 30px 0; }
        .search-bar { max-width: 400px; margin: 0 auto 30px auto; }
        .back-btn-floating {
            position: fixed; bottom: 20px; right: 20px;
            background-color: #264653; color: white;
            padding: 12px 25px; text-decoration: none;
            border-radius: 8px; font-size: 16px;
        }
        .back-btn-floating:hover { background-color: #21867a; transform: scale(1.05); }
        .back-btn-floating::before { content: "← "; }
    </style>
</head>
<body>
    <div id="header-container"></div>
    <script src="navHandler.js"></script>
   <?php include 'nav.php'; ?>

    <main class="container">
        <h1><?= $mesazhiFaqes ?></h1>
        <p class="text-center"><em><?= $koment ?></em></p>

        <input type="text" class="form-control search-bar" id="searchInput" placeholder="Kërko zhvillim...">

        <div class="row mt-4" id="resultContainer">
            <?php
            foreach ($mundesite as $titull => $pershkrim) {
                $foto = emriFotos($titull);
                $m = new Mundesi($titull, $pershkrim, $foto);
                echo $m->shfaq();
            }
            ?>
        </div>
    </main>

    <a href="keshilla.php" class="back-btn-floating" onclick="kthehu();"></a>
    <!-- Include footer -->
    <?php include 'footer.php';?>
    <script src="loginPopup.js"></script>
</body>
</html>
