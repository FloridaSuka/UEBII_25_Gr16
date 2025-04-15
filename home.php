<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orientimi n&#235; Karrier&#235;</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="homestyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="scroll-behavior: smooth;">
    <div id="header-container"></div>

    <script src="js/navHandler.js"></script>
    <script>
        fetch('nav.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-container').innerHTML = data;
                setupNavigation();
            })
            .catch(err => console.error('Gabim gjat&#235; ngarkimit t&#235; header-it:', err));
    </script>

    <section class="hero">
        <div class="container">
            <h2>Nd&#235;rto t&#235; Ardhmen T&#235;nde Profesionale!</h2>
            <p>Gjeni mund&#235;sit&#235; p&#235;r nj&#235; karrier&#235; t&#235; suksesshme me orientimin e duhur.</p>
            <a href="#jobs" class="btn-primary">Shiko Mund&#235;sit&#235;</a>
        </div>
    </section>

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

                    $punet = [
                        new Puna("Arkitekt", "Dizajnon hap&#235;sira funksionale dhe estetike."),
                        new Puna("Avokat", "Mbron dhe k&#235;shillon n&#235; ç&#235;shtje ligjore."),
                        new Puna("Inxhinier", "Planifikon dhe nd&#235;rton struktura."),
                        new Puna("Stomatolog", "Kujdeset p&#235;r sh&#235;ndetin oral.")
                    ];

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

    <div id="footer-container"></div>
    <script>
        fetch('footer.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer-container').innerHTML = data;
            })
            .catch(err => console.error('Gabim gjat&#235; ngarkimit t&#235; footer-it:', err));
    </script>

</body>
</html>
