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

    <main class="container">
        <h1><?php echo $mesazhiFaqes; ?></h1>
        <p style="text-align:center">Totali i faktorëve: <?php echo $GLOBALS['numri_faktoreve']; ?></p>
        <?php
        foreach ($faktoretTituj as $titull) {
            $kat = $faktoretKategoria[$titull] ?? KATEGORIA_DEFAULT;
            $faktor = new FaktorZgjeruar($titull, $kat, rand(0, 1));
            echo "<div class='faktor'>" . $faktor->info() . "</div>";
        }

        $aktiv = numroAktivet(array_map(function($t) use ($faktoretKategoria) {
            return new FaktorZgjeruar($t, $faktoretKategoria[$t] ?? KATEGORIA_DEFAULT, rand(0, 1));
        }, $faktoretTituj));

        echo "<p style='text-align:center'><em>Faktorë aktiv: $aktiv</em></p>";
        ?>
    </main>

    <a href="#" class="back-btn-floating" onclick="kthehu();"></a>
    <div id="footer-container"></div>

    <script src="navHandler.js"></script>
    <script src="loginPopup.js"></script>
    <script>
        fetch('nav.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-container').innerHTML = data;
                if (typeof setupNavigation === "function") setupNavigation();

                const loginIcon = document.getElementById('loginIcon');
                const loginModal = document.getElementById('loginModal');
                const closeBtn = document.getElementById('closeBtn');
                const initialPosition = { top: 50, left: 50 };

                if (loginIcon) {
                    loginIcon.addEventListener('click', () => {
                        loginModal.style.display = 'block';
                        loginModal.style.top = `${initialPosition.top}px`;
                        loginModal.style.left = `${initialPosition.left}px`;
                    });
                }
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        loginModal.style.display = 'none';
                    });
                }

                loginModal?.addEventListener('dblclick', () => {
                    loginModal.style.top = `${initialPosition.top}px`;
                    loginModal.style.left = `${initialPosition.left}px`;
                });

                window.addEventListener('click', (e) => {
                    if (e.target === loginModal) {
                        loginModal.style.display = 'none';
                    }
                });

                let offsetX = 0, offsetY = 0;
                loginModal?.addEventListener('dragstart', (e) => {
                    const rect = loginModal.getBoundingClientRect();
                    offsetX = e.clientX - rect.left;
                    offsetY = e.clientY - rect.top;
                });

                document.addEventListener('dragover', (e) => e.preventDefault());
                document.addEventListener('drop', (e) => {
                    e.preventDefault();
                    const x = e.clientX - offsetX;
                    const y = e.clientY - offsetY;
                    loginModal.style.top = `${y}px`;
                    loginModal.style.left = `${x}px`;
                });
            });

        fetch('footer.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer-container').innerHTML = data;
            });

<<<<<<< Updated upstream
    <!-- Main content -->
    <main class="faktoret-main">
        <h1 class="faktoret-h1">Faktorët Ndikues në Përzgjedhjen e Karrierës</h1>

        <section id="section1" class="faktoret-section">
            <h2 class="faktoret-h2">Interesat Personale</h2>
            <p class="faktoret-p">
                <strong>Interesat personale</strong> janë një faktor shumë i rëndësishëm në përzgjedhjen e karrierës. Çdo individ ka interesa të ndryshme, dhe është e rëndësishme që ky interes të përputhet me zgjedhjen e profesionit. Për shembull, një person që ka interes në teknologji mund të preferojë një karrierë në fushën e IT-së, ndërsa dikush që do të punojë me njerëz mund të jetë i orientuar drejt fushave si psikologjia ose edukimi.
            </p>
            <img class="faktoret-img" src="foto/faktoretNdikues.jpg" alt="Interesat Personale" style="max-width: 85%; height: 455px; margin: 20px auto 20px auto; display: block; border-radius: 8px;">
        </section>

        <section id="section2" class="faktoret-section">
            <h2 class="faktoret-h2">Aftësitë dhe Shkathtësitë</h2>
            <p class="faktoret-p">
                <strong>Aftësitë dhe shkathtësitë</strong> e individëve janë një faktor tjetër që ndikojnë në përzgjedhjen e karrierës. Aftësitë profesionale dhe teknike mund të jenë vendimtare për suksesin në një fushë të caktuar. Disa mund të kenë aftësi të shkëlqyera në komunikim, ndërsa të tjerë mund të jenë të aftë për të analizuar të dhëna dhe të punojnë me teknologji. Zgjedhja e një karriere duhet të bazohet në ato aftësi që individi i ka zhvilluar gjatë jetës.
            </p>
            <img class="faktoret-img" src="foto/faktoretNdikues1.jpeg" alt="Aftësitë dhe Shkathtësitë" style="max-width: 88%; height: 455px; margin: 20px auto 20px auto; display: block; border-radius: 8px;">
        </section>

        <section id="section3" class="faktoret-section">
            <h2 class="faktoret-h2">Vlerat dhe Besimet</h2>
            <p class="faktoret-p">
                <strong>Vlerat dhe besimet</strong> janë gjithashtu faktore kyç në zgjedhjen e karrierës. Disa individë mund të jenë të angazhuar për çështje mjedisore dhe mund të kërkojnë një karrierë që kontribuon në mbrojtjen e natyrës. Të tjerë mund të kërkojnë mundësi që i lejojnë të ndihmojnë komunitetin dhe të krijojnë impakt pozitiv në jetën e njerëzve. Zgjedhja e karrierës duhet të pasqyrojë vlerat personale dhe misionin jetësor të individit.
            </p>
            <img class="faktoret-img"src="foto/faktoretNdikues5.jpeg" alt="Vlerat dhe Besimet" style="max-width: 88%; height: 455px; margin: 20px auto 20px auto;; display: block; border-radius: 8px;">
        </section>

        <section id="section4" class="faktoret-section">
            <h2 class="faktoret-h2">Shanset Ekonomike dhe Tregu i Punës</h2>
            <p class="faktoret-p">
                <strong>Shanset ekonomike dhe tregu i punës</strong> janë gjithashtu një faktor shumë i rëndësishëm në përzgjedhjen e karrierës. Shumë individë mund të zgjedhin një profesion që ofron mundësi të mira për punësim dhe rritje ekonomike. Në disa raste, individët mund të orientohen drejt fushave që janë në kërkesë, siç janë teknologjia, mjekësia, dhe inxhinieria, duke pasur parasysh edhe mundësitë për përparim dhe fitim.
            </p>
            <img class="faktoret-img" src="foto/faktoretNdikues2.jpg" alt="Shanset Ekonomike" style="max-width: 88%; height: 455px; margin: 20px auto 20px auto;display: block; border-radius: 8px;">
        </section>

        <section id="section5" class="faktoret-section">
            <h2 class="faktoret-h2">Ndikimi i Familjes dhe Rrethinës Sociale</h2>
            <p class="faktoret-p">
                <strong>Familja dhe rrethi social</strong> kanë gjithashtu ndikim të madh në zgjedhjen e karrierës. Mbështetja dhe sugjerimet nga anëtarët e familjes, si dhe ndikimi i shoqërisë dhe miqve, mund të formojnë zgjedhjen profesionale të individëve. Kjo është veçanërisht e vërtetë për ata që janë të rinj dhe mund të kenë nevojë për orientim në këtë proces të rëndësishëm.
            </p>
            <img class="faktoret-img" src="foto/faktoretNdikues3.jpg" alt="Familja dhe Rrethina Sociale" style="max-width: 88%; height: 455px; margin: 20px auto 20px auto; display: block; border-radius: 8px;">
        </section>

        <section id="section6" class="faktoret-section">
            <h2 class="faktoret-h2">Eksperiencat dhe Praktika</h2>
            <p class="faktoret-p">
                <strong>Eksperiencat dhe praktika</strong> e individëve luajnë një rol të rëndësishëm në zgjedhjen e karrierës. Pjesëmarrja në aktivitete të ndryshme dhe praktikat profesionale ndihmojnë individët të kuptojnë më mirë atë që duan të bëjnë dhe në cilën fushë janë më të fortë. Eksperiencat e para në punë janë një mundësi e shkëlqyer për të mësuar dhe për të zgjeruar horizontet profesionale.
            </p>
            <img class="faktoret-img" src="foto/faktoretNdikues4.jpeg" alt="Eksperiencat dhe Praktika" style="max-width: 88%; height: 455px; margin: 20px auto 20px auto; display: block; border-radius: 8px;">
        </section>
    </main>
     <!-- Shigjeta flotuese për kthim -->
     <a href="#" class="back-btn-floating" onclick="kthehu();"></a>

    <!-- Include footer -->
<?php include 'footer.php';?>
<script>
  // Funksioni për navigim te faqja e re
      function kthehu() {
        window.location.href = "keshilla.html"; // Këtu vendos destinacionin tënd
    }
=======
        function kthehu() {
            window.location.href = "keshilla.html";
        }
>>>>>>> Stashed changes
    </script>
</body>
</html>
