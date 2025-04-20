<?php
define("NGJYRA_TITULLIT", "#264653");
$titulliFaqes = "5 Libra për të Frymëzuar Suksesin";
$mesazh = "Lista e librave më të rekomanduar për sukses";

$librat = [
    ["titulli" => "The Power of Habit", "autori" => "Charles Duhigg"],
    ["titulli" => "Atomic Habits", "autori" => "James Clear"],
    ["titulli" => "The 7 Habits of Highly Effective People", "autori" => "Stephen Covey"],
    ["titulli" => "Think and Grow Rich", "autori" => "Napoleon Hill"],
    ["titulli" => "Start with Why", "autori" => "Simon Sinek"]
];

function formatoLibrin($titull, $autor) {
    return "<strong>\"" . strtoupper($titull) . "\"</strong> - $autor";
}

class Libri {
    protected $titull;
    protected $autor;

    public function __construct($titull, $autor) {
        $this->titull = $titull;
        $this->autor = $autor;
    }

    public function getTitull() {
        return $this->titull;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setTitull($titull) {
        $this->titull = $titull;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function info() {
        return formatoLibrin($this->titull, $this->autor);
    }
}

class LibriMotivues extends Libri {
    private $fokus;

    public function __construct($titull, $autor, $fokus) {
        parent::__construct($titull, $autor);
        $this->fokus = $fokus;
    }

    public function getFokus() {
        return $this->fokus;
    }

    public function info() {
        return parent::info() . "<br><em>Fokus: " . $this->fokus . "</em>";
    }
}
$gjatesia = count($librat);
for ($i = 0; $i < $gjatesia - 1; $i++) {
    for ($j = 0; $j < $gjatesia - $i - 1; $j++) {
        if (strcmp($librat[$j]['titulli'], $librat[$j + 1]['titulli']) > 0) {
            $temp = $librat[$j];
            $librat[$j] = $librat[$j + 1];
            $librat[$j + 1] = $temp;
        }
    }
}
$GLOBALS['numri_librave'] = count($librat);
//var_dump($librat);  eshte perdor per debug
?>


<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulliFaqes; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #264653;
            border-radius: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #e6e3e3fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fefefe;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: <?= NGJYRA_TITULLIT ?>;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .libri {
            background-color: <?= NGJYRA_TITULLIT ?>;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .libri:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(38, 70, 83, 0.3);
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
    <!-- NAV -->
    <div id="header-container"></div>
    <script src="navHandler.js"></script>
    <script>
        fetch('nav.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-container').innerHTML = data;
                setupNavigation();
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
                loginModal.addEventListener('dblclick', () => {
                    loginModal.style.top = `${initialPosition.top}px`;
                    loginModal.style.left = `${initialPosition.left}px`;
                });
                window.addEventListener('click', (e) => {
                    if (e.target === loginModal) {
                        loginModal.style.display = 'none';
                    }
                });
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
            .catch(err => console.error('Gabim gjatë ngarkimit të navit:', err));
    </script>

    <!-- Përmbajtja kryesore -->
    <div class="container">
        <h2><?php echo $titulliFaqes; ?></h2>
        <p><?php echo $mesazh; ?></p>
        <?php
        if ($GLOBALS['numri_librave'] >= 5) {
            echo "<p>📚 Këta libra mund ta ndryshojnë jetën tënde!</p>";
        } else {
            echo "<p>Leximi është çelësi i suksesit – shto më shumë libra!</p>";
        }

        foreach ($librat as $info) {
            if (isset($info['titulli']) && isset($info['autori'])) {
                $libri = new LibriMotivues($info['titulli'], $info['autori'], "Zhvillim Personal");
                echo "<div class='libri'>" . $libri->info() . "</div>";
               // var_dump($libri); eshte perdor per debug
            }
        }
        ?>
    </div>

    <!-- Shigjeta flotuese për kthim -->
    <a href="#" class="back-btn-floating" onclick="kthehu();"></a>

    <!-- Include footer -->
    <?php include 'footer.php';?>
<script>
        function kthehu() {
            window.location.href = "keshilla.php";
        }
    </script>
    <script src="loginPopup.js"></script>
</body>
</html>
