<?php include 'cookie-box.php';?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orientimi n&#235; Karrier&#235;</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="homestyle.css">
</head>
<body style="scroll-behavior: smooth;">
    <div id="header-container"></div>

    <script src="navHandler.js"></script>
    <?php include 'nav.php'; ?>

    <section class="hero" id = "heroSection">
        <div class="container">
            <h2>Nd&#235;rto t&#235; Ardhmen T&#235;nde Profesionale!</h2>
            <p>Gjeni mund&#235;sit&#235; p&#235;r nj&#235; karrier&#235; t&#235; suksesshme me orientimin e duhur.</p>
            <a href="#jobs" class="btn-primary">Shiko Mund&#235;sit&#235;</a>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pranuar = document.cookie.split('; ').find(row => row.startsWith('cookiePranuar='));
            const value = pranuar ? pranuar.split('=')[1] : null;

            if (value === "po") {
                const hero = document.getElementById("heroSection");
                if (hero) {
                    hero.style.backgroundImage = "radial-gradient(circle, rgba(47, 38, 38, 0.4), rgba(255, 255, 255, 0.4)), url('foto/background2.jpg')";
                }
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".btn-primary").click(function () {
                $("#jobs").slideToggle(600);
            });
        });
    </script>

    <section id="jobs" class="jobs-section" style="display: none;">
        <div class="mundesite-container">
            <h3>Mund&#235;sit&#235; e Pun&#235;s</h3>
            <div class="job-list">
                <?php
                    class Puna {
                        public $titulli;
                        public $pershkrimi;

                        function __construct($titulli, $pershkrimi) {
                            $this->titulli = $titulli;
                            $this->pershkrimi = $pershkrimi;
                        }

                        function shfaq() {
                            echo "<div class='job-card'>";
                            echo "<h4>{$this->titulli}</h4>";
                            echo "<p>{$this->pershkrimi}</p>";
                            echo "<a href='Detajet{$this->titulli}.php' class='btn btn-light'>Shiko detajet</a>";
                            echo "</div>";
                        }
                    }

                    $arkitekt = new Puna("Arkitekt", "Dizajnon hapësira funksionale dhe estetike.");
                    $avokat = new Puna("Avokat", "Mbron dhe këshillon në çështje ligjore.");
                    $inxhinier = new Puna("Inxhinier", "Planifikon dhe ndërton struktura.");
                    $stomatolog = new Puna("Stomatolog", "Kujdeset për shëndetin oral.");
                    $mesues = new Puna("Mesues", "Kujdeset edukimin e nxenesve.");


                    $punet = [];
                    $punet[] = &$arkitekt;     
                    $punet[] = $avokat;
                    $punet[] = $mesues;
                    $punet[] = $inxhinier;

                    function ndryshoTitullin(&$obj, $riTitull) {
                        $obj->titulli = $riTitull;
                    }
                    ndryshoTitullin($punet[1], "Jurist"); 

                    $kopje = $punet[0]; 
                    $kopje->titulli = "Arkitekt i Brendshëm"; 

                    $punet[] = $stomatolog;
                    unset($punet[2]); 

                    foreach ($punet as $pune) {
                        $pune->shfaq();
                    }

                ?>
            </div>
        </div>
    </section>

    <section id="benefits" class="benefits-section">
        <div class="container">
            <h3>P&#235;rfitimet q&#235; Ofrojm&#235; Ne</h3>
            <div class="benefits-list">
                <div class="benefit-item">
                    <img src="foto/stapler-solid.svg" alt="">
                    <h4>Trajnime dhe Zhvillim</h4>
                    <p>Ofroni mund&#235;si zhvillimi t&#235; vazhduesh&#235;m p&#235;r t&#235; rritur suksesin tuaj profesional.</p>
                </div>
                <div class="benefit-item">
                    <img src="foto/business-time-solid.svg" alt="">
                    <h4>Orar Fleksibil</h4>
                    <p>Mund&#235;si p&#235;r orar fleksibil dhe pun&#235; nga distanca.</p>
                </div>
                <div class="benefit-item">
                    <img src="foto/seedling-solid.svg" alt="">
                    <h4>Ambient i P&#235;rshtatsh&#235;m</h4>
                    <p>Ambient modern dhe bashk&#235;kohor p&#235;r zhvillim personal dhe kolektiv.</p>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php';?>
</body>
</html>


