<?php
session_start();
$emri = $_SESSION['first_name'] ?? '';
$mbiemri = $_SESSION['last_name'] ?? '';
ob_start();
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Detajet e Profesionit - Specialist Marketingu</title>
    <style>
         ::-webkit-scrollbar{
        width: 10px;
        }
        ::-webkit-scrollbar-track{
        
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb{
            background:#264653;
            border-radius: 10px;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eef2f3;
            color: #333;
            line-height: 1.6;
        }

        main {
            padding: 20px;
            max-width: 900px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .profession-title {
            background-color: #264653;
            color: white;
            padding: 15px 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profession-details {
            position: relative;
            background-image: url('foto/marketing.jpg'); 
            background-size: cover;
            background-position:center;
            background-repeat: no-repeat;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        .profession-details .info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(38, 70, 83, 0.8);
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            text-align: left;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .requirements {
            margin-top: 20px;
            padding: 20px;
            border-top: 1px solid #264653;
        }

        h2 {
            color: #264653;
            margin-bottom: 15px;
        }

        .ul {
            padding-left: 20px;
            list-style: none;
        }

        .ul li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .ul li::before {
            content: "";
            width: 10px;
            height: 10px;
            background-color: #264653;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: #21867a;
            transform: scale(1.05);
        }

        .image-section {
            margin-top: 20px;
            text-align: center;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .form-section {
            margin-top: 40px;
            background-color: hwb(210 97% 0%);
            padding: 20px;
            border-radius: 10px;
            color: #333;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .form-section label {
           
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-section .input, .form-section textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-section button {
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #21867a;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #264653;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
        }

        .back-btn:hover {
            background-color: #21867a;
            transform: scale(1.05);
        }

        .back-btn::before {
            content: "←"; 
            font-size: 18px;
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
        }
    </style>
    <script>
        function calculateMatch() {
            const totalSkills = 5; // Numri total i aftësive të kërkuara
            const selectedSkills = document.querySelectorAll('input[type="checkbox"]:checked').length;
            const matchPercentage = (selectedSkills / totalSkills) * 100;
            document.getElementById('matchOutput').value = matchPercentage.toFixed(0) + "%";
        }
    </script>
</head>
<body>
   <!-- importo file te html per nav ne div -->

   <div id="header-container"></div>
   <script>
    // JavaScript për të ngarkuar header-in nga file-i i jashtëm
    fetch('nav.html')
    .then(response => response.text())
    .then(data => {
        // Vendos përmbajtjen e header-it në div-in me id="header-container"
        document.getElementById('header-container').innerHTML = data;
        // Lidh eventet pasi përmbajtja të jetë ngarkuar
        const loginIcon = document.getElementById('loginIcon');
        const loginModal = document.getElementById('loginModal');
        const closeBtn = document.getElementById('closeBtn');
        const initialPosition = { top: 50, left: 50 }; // Pozita fillestare e modalit

        //hap modalin
        if (loginIcon) {
            loginIcon.addEventListener('click', () => {
                loginModal.style.display = 'block';
                loginModal.style.top = `${initialPosition.top}px`;
                loginModal.style.left = `${initialPosition.left}px`;
            });
        }
        //mbyll modalin
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                loginModal.style.display = 'none';
            });
        }
       // Kthimi i modalit në pozitën fillestare
        loginModal.addEventListener('dblclick', () => {
            loginModal.style.top = `${initialPosition.top}px`;
            loginModal.style.left = `${initialPosition.left}px`;
        });
        //mbyllja kur klikohet jasht modalit
        window.addEventListener('click', (e) => {
            if (e.target === loginModal) {
                loginModal.style.display = 'none';
            }
        });
        // Drag and drop
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
    .catch(err => console.error('Gabim gjat&#235 ngarkimit t&#235 header-it:', err));
</script>
<main>
    <div class="profession-title">
      <b>  Detajet e Profesionit - Specialist Marketingu</b>
    </div>

    <div class="profession-details">
    </div>

    <div class="profilit">
        <h1>
            Profili i Specialistit të Marketingut
        </h1>
        <h3>
            Krijimi dhe zbatimi i strategjive për promovimin e produkteve dhe shërbimeve.
        </h3>
    </div>

    <div class="requirements">
        <h2>Kërkesat Kryesore</h2>
        <ul class="ul">
            <li class="li">Njohuri mbi analizën e tregut dhe menaxhimin e markës.</li>
            <li class="li">Aftësi në përdorimin e platformave digjitale si Google Ads, Facebook Ads, etj.</li>
            <li class="li">Kreativitet në krijimin e fushatave marketingu tërheqëse.</li>
            <li class="li">Aftësi të mira në komunikim dhe koordinim me ekipin.</li>
        </ul>
    </div>

    <h2>Përfitimet</h2>
    <p>
        Duke punuar si specialist marketingu, mund të përfitoni:
    </p>
    <ul class="ul">
        <li class="li">Mundësi për të punuar me marka të njohura dhe për të ndikuar në suksesin e tyre.</li>
        <li class="li">Njohuri të avancuara mbi trendet e fundit në marketingun digjital.</li>
        <li class="li">Mundësi për zhvillim profesional në një fushë gjithnjë në rritje.</li>
    </ul>

    
    <!-- Seksioni i Aplikimit -->
    <?php

// ------------------- BACKEND LOGJIKA -------------------
define("MIN_AGE", 18);
define("MAX_AGE", 65);

if (!function_exists('isValidEmailOrPhone')) {
    function isValidEmailOrPhone($input) {
        $emailRegex = "/^[\w\-.]+@[\w\-]+\.\w{2,4}$/";
        $phoneRegex = "/^\+?[0-9]{8,15}$/";
        return preg_match($emailRegex, $input) || preg_match($phoneRegex, $input);
    }
}

if (!function_exists('isCapitalized')) {
    function isCapitalized($str) {
        return preg_match("/^[A-ZÇË]/", $str);
    }
}

class Applicant {
    private $firstName;
    private $lastName;
    private $emailOrPhone;
    private $age;
    private $city;
    private $experience;
    private $skills = [];

    public function __construct($f, $l, $e, $a, $c, $ex, $sk) {
        $this->firstName = $f;
        $this->lastName = $l;
        $this->emailOrPhone = $e;
        $this->age = $a;
        $this->city = $c;
        $this->experience = $ex;
        $this->skills = $sk;
    }

    public function summary() {
        return "Aplikuesi <b>{$this->firstName} {$this->lastName}</b>, nga <b>{$this->city}</b>, me moshë <b>{$this->age}</b>, ka përvojë: <b>{$this->experience}</b>, dhe ka zgjedhur " . count($this->skills) . " aftësi.";
    }
}

$errors = [];
$result = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST['first-name'] ?? '';
    $lastName = $_POST['last-name'] ?? '';
    $contact = $_POST['phone-or-email'] ?? '';
    $age = $_POST['age'] ?? 0;
    $city = $_POST['qyteti'] ?? '';
    $experience = $_POST['experience'] ?? 'jo';
    $skills = $_POST['skill'] ?? [];

    if (strlen($firstName) < 2 || !isCapitalized($firstName)) $errors[] = "Emri duhet të fillojë me shkronjë të madhe.";
    if (strlen($lastName) < 2 || !isCapitalized($lastName)) $errors[] = "Mbiemri duhet të fillojë me shkronjë të madhe.";
    if (!isValidEmailOrPhone($contact)) $errors[] = "Email ose numër telefoni i pavlefshëm.";
    if ($age < MIN_AGE || $age > MAX_AGE) $errors[] = "Mosha duhet të jetë mes " . MIN_AGE . " dhe " . MAX_AGE . ".";

    if (empty($errors)) {
        $applicant = new Applicant($firstName, $lastName, $contact, $age, $city, $experience, $skills);
    
$_SESSION['first_name'] = $firstName;
$_SESSION['last_name'] = $lastName;
header("Location: aplikimi.php");
exit();

        header("Location: aplikimi.php");
        exit();
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Forma e Aplikimit</title>
<<<<<<< HEAD
    <style>
   .form-section {
    max-width: 1000px;
    margin: 0 auto;
    padding: 30px;
    background-color: #f6fbff; /* ngjyrë e lehtë si në imazh */
    border: 1px solid #ccc;
    border-radius: 10px;
}
=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div id="header-container"></div>
    <script src="navHandler.js"></script>
    <script>
        fetch('nav.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-container').innerHTML = data;
                setupNavigation(); // Funksioni nga navHandler.js
                const loginIcon = document.getElementById('loginIcon');
                const loginModal = document.getElementById('loginModal');
                const closeBtn = document.getElementById('closeBtn');
            const initialPosition = { top: 50, left: 50 }; // Pozita fillestare e modalit
  
            //hap modalin
            if (loginIcon) {
                loginIcon.addEventListener('click', () => {
                    loginModal.style.display = 'block';
                    loginModal.style.top = `${initialPosition.top}px`;
                    loginModal.style.left = `${initialPosition.left}px`;
                });
            }
            //mbyll modalin
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    loginModal.style.display = 'none';
                });
            }
           // Kthimi i modalit në pozitën fillestare
            loginModal.addEventListener('dblclick', () => {
                loginModal.style.top = `${initialPosition.top}px`;
                loginModal.style.left = `${initialPosition.left}px`;
            });
            //mbyllja kur klikohet jasht modalit
            window.addEventListener('click', (e) => {
                if (e.target === loginModal) {
                    loginModal.style.display = 'none';
                }
            });
            // Drag and drop
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
            .catch(err => console.error('Gabim gjatë ngarkimit të header-it:', err));
    </script>
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
>>>>>>> 0730b6ef80fdd9db681352da3873e7bb41d1ff43

/* Stilizimi i inputeve të zakonshme me distancë më të vogël */
.form-section input[type="text"],
.form-section input[type="number"],
.form-section input[list],
.form-section select,
.form-section input[type="email"],
.form-section input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0; /* zvogëluar nga 10px në 5px */
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: white;
}

/* Inputi për moshën me madhësi më të vogël */
.form-section input[name="age"] {
    width: 100px;
    display: inline-block;
    margin-left: 10px;
}

/* Etiketa për moshën për të qenë në vijë me inputin */
.form-section label[for="age"] {
    font-weight: bold;
    display: inline-block;
    margin-bottom: 3px;
}

/* Butoni */
.form-section input[type="submit"] {
    background-color: #264653;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

/* Hover efekti për buton */
.form-section input[type="submit"]:hover {
    background-color: #21867a;
}

/* Etiketat me pak hapësirë */
.form-section label {
    font-weight: bold;
    display: block;
    margin-top: 8px; /* më pak se 15px */
    margin-bottom: 3px;
}


    </style>
</head>
<body>
<div class="form-section">
    <h3>Aplikoni për këtë pozitë</h3>

    <?php if (!empty($errors)) : ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Emri</label>
        <input type="text" name="first-name" pattern="[A-ZÇË][a-zçë\s]*" title="Filloni me shkronjë të madhe" value="<?php echo htmlspecialchars($firstName ?? '') ?>" required>

        <label>Mbiemri</label>
        <input type="text" name="last-name" pattern="[A-ZÇË][a-zçë\s]*" title="Filloni me shkronjë të madhe" value="<?php echo htmlspecialchars($lastName ?? '') ?>" required>

        <label>Email ose Nr. Telefonit</label>
        <input type="text" name="phone-or-email" pattern="(\+?[0-9]{8,15}|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})" title="Shkruani vetëm një email ose një numër telefoni valid" value="<?php echo htmlspecialchars($contact ?? '') ?>" required>

        <label>Mosha</label>
        <input type="number" name="age" min="18" max="65" value="<?php echo htmlspecialchars($age ?? '') ?>" required>

        <label>Qyteti</label>
        <input list="qyteti" name="qyteti" value="<?php echo htmlspecialchars($city ?? '') ?>">
        <datalist id="qyteti">
            <option value="Prishtinë">
            <option value="Pejë">
            <option value="Mitrovicë">
            <option value="Gjilan">
            <option value="Prizren">
        </datalist>

        <label>Eksperiencë</label><br>
        <input type="radio" name="experience" value="po" <?php if (($experience ?? '') === 'po') echo 'checked'; ?>> Po
        <input type="radio" name="experience" value="jo" <?php if (($experience ?? '') === 'jo') echo 'checked'; ?>> Jo<br><br>

        <label>Aftësitë</label><br>
        <?php
      $aftesite = [
        1 => "Krijimi dhe menaxhimi i fushatave promocionale",
        2 => "Aftësi në marketingun digjital (SEO, SEM, email marketing)",
        3 => "Përdorimi i rrjeteve sociale për promovim",
        4 => "Analizimi i të dhënave të tregut dhe sjelljes së klientëve",
        5 => "Shkrimi kreativ dhe përgatitja e përmbajtjeve reklamues"
    ];
    
        foreach ($aftesite as $key => $label) {
            $checked = (isset($skills) && in_array($key, $skills)) ? 'checked' : '';
            echo "<label><input type='checkbox' name='skill[]' value='$key' $checked> $label</label><br>";
        }
        ?>

        <br><input type="submit" value="Apliko">
    </form>
</div>
    </main>
<!-- Shigjeta flotuese për kthim -->
<a href="#" class="back-btn-floating" onclick="shkoTeFaqja();"></a>

<div id="footer-container"></div>
<script>
    // JavaScript për ngarkimin e footer-it nga file-i i jashtëm
    fetch('footer.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer-container').innerHTML = data;
        })
        .catch(err => console.error('Gabim gjatë ngarkimit të footer-it:', err));

    // Funksioni për navigim te faqja e re
    function shkoTeFaqja() {
        window.location.href = "shpalljet.html"; // Këtu vendos destinacionin tënd
    }
</script>
<script src="loginPopup.js"></script>
</body>
</html>
