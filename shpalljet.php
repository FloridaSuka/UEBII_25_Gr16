<?php include 'cookie-box.php';?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function errorHandler($errno, $errstr, $errfile, $errline)
{
    $mesazh = "<div style='background-color: #ffe6e6; color: #a94442; padding: 15px; margin: 15px; border-left: 5px solid #a94442;'>
        <strong>⚠️ Gabim [$errno]:</strong> $errstr<br>
        <strong>📄 Skedari:</strong> $errfile <br>
        <strong>📌 Rreshti:</strong> $errline
    </div>";

    echo $mesazh;

    // 📁 Sigurohu që ekziston folderi logs
    $logFolder = __DIR__ . "/logs";
    if (!file_exists($logFolder)) {
        mkdir($logFolder, 0777, true);
    }

    // 📝 Pastaj shkruaj gabimin në fajll
    $logPath = $logFolder . "/error_log.txt";
    $logData = "[" . date("Y-m-d H:i:s") . "] Gabim [$errno] në $errfile, rreshti $errline: $errstr" . PHP_EOL;
    file_put_contents($logPath, $logData, FILE_APPEND);
}

set_error_handler("errorHandler");

session_start();
if (!isset($_SESSION['user_id'])) {
    $mesazhi = urlencode("Ju duhet të kyçeni për të parë shpalljet.");
    echo "<script>
        window.location.href = 'index.php?mesazh=$mesazhi&redirect=shpalljet.php';
    </script>";
    exit();
}

?>

<!-- Pjesa tjetër e HTML për shpalljet -->

<!DOCTYPE html>
<html lang="sq">
<head>
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punë Praktike</title>
    <link rel="stylesheet" href="shpalljet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <style>
#chatContainer {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: white;
  width: 320px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  font-family: sans-serif;
  z-index: 9999;
}

#chatHeader {
  background-color: #2a9d8f;
  color: white;
  padding: 8px 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 10px 10px 0 0;
}

#chatInput {
  width: 100%;
  padding: 10px;
  border-top: 1px solid #ccc;
  border: none;
  border-radius: 0 0 10px 10px;
}

#pyetjetSugjeruara button {
  margin: 5px 5px 0 0;
  background: #e0f7fa;
  border: none;
  padding: 5px 10px;
  border-radius: 6px;
  cursor: pointer;
}


    </style>
</head>
<body>
<script>
function pergjigjeEPergatitur(pyetja) {
  const log = document.getElementById("chatLog");
  log.innerHTML += `<p><strong>Ti:</strong> ${pyetja}</p>`;

  let pergjigje = "⛔ Nuk ka përgjigje.";
  switch (pyetja) {
    case "Si të aplikoj?":
      pergjigje = "Për të aplikuar, zgjidh një pozitë dhe kliko butonin 'Apliko'.";
      break;
    case "Çfarë dokumentesh kërkohen?":
      pergjigje = "Zakonisht kërkohet CV dhe letër motivimi.";
      break;
    case "A ka vende të lira për IT?":
      pergjigje = "Po, kemi disa pozita në sektorin e IT-së.";
      break;
    case "Si mund të kontaktoj kompaninë?":
      pergjigje = "Të gjitha informacionet e kontaktit janë në fund të shpalljes.";
      break;
  }

  log.innerHTML += `<p><strong>Asistenti:</strong> ${pergjigje}</p>`;
  log.scrollTop = log.scrollHeight;
}
function minimizeChat() {
  const content = document.getElementById("chatContent");
  content.style.display = content.style.display === "none" ? "block" : "none";
}


function closeChat() {
  document.getElementById("chatContainer").style.display = "none";
}



</script>



   
    <main>
      <div id="header-container"></div>
    <script src="navHandler.js"></script>
    <?php include 'nav.php'; ?>
  </div>
    <section>
      <input style = "margin-top: 20px;" type="text" id="kerko" onkeyup="kerko()" placeholder="Kerko..">
     

      <br>
      
 <div class="dropdown">
  <button onclick="toggleDropdown(event, 'myDropdown')" class="dropbtn">
    Qytetet <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;"></span>
  </button>

  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Kërko qytetin..." id="myInput" onkeyup="filterFunction()">

    <a class="linku" href="#" onclick="filterByCity(this)">Prishtinë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Pejë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Mitrovicë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Gjilan</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Prizren</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Ferizaj</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Gjakovë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Fushë Kosovë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Podujevë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Obiliq</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Drenas</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Vushtrri</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Suharekë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Rahovec</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Malishevë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Kamenicë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Istog</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Skenderaj</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Dragash</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Kaçanik</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Deçan</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Klinë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Leposaviq</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Zubin Potok</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Zveçan</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Shtime</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Shtërpcë</a>
    <a class="linku" href="#" onclick="filterByCity(this)">Novobërdë</a>
  </div>
</div>

      <div class="dropdown">
        <button onclick="toggleDropdown(event, 'myDropdown2')" class="dropbtn">Fushat <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;" ></span></button>
        <div id="myDropdown2" class="dropdown-content">
          <input type="text" placeholder="Search.." id="myInput2" onkeyup="filterFunction2()">
          <a href="#" onclick="filterByCategory(this)">Arkitekturë</a>
          <a href="#" onclick="filterByCategory(this)">Arsim</a>
          <a href="#" onclick="filterByCategory(this)">Financa</a>
          <a href="#" onclick="filterByCategory(this)">Hoteleri</a>
          <a href="#" onclick="filterByCategory(this)">Inxhinieri</a>
          <a href="#" onclick="filterByCategory(this)">IT</a>
          <a href="#" onclick="filterByCategory(this)">Marketing</a>
          <a href="#" onclick="filterByCategory(this)">Media & Art</a>
          <a href="#" onclick="filterByCategory(this)">Shëndetësi</a>
          <a href="#" onclick="filterByCategory(this)">Sherbime Juridike</a>
          <a href="#" onclick="filterByCategory(this)">Teknologji</a>
          <a href="#" onclick="filterByCategory(this)">Transport</a>
         <a href="#" onclick="filterByCategory(this)">Kuzhinë</a>
         
        </div>
      </div>
      </div>
      
      
     
        <button onclick="resetFilters()" class="reset-btn">
          Rifillo Filtrimet
        </button>
        </div>
      </div>
      </div>
    </section>
     <div style="display: flex; align-items: center; justify-content: space-between; margin: 40px 100px -60px 100px;">
    <!-- Ikona + -->
<div id="shtoShpalljeBtn"
     style="font-size: 20px; cursor: pointer; margin-left: 150px; margin-top:-10px;"
     data-roli="<?php echo $_SESSION['roli'] ?? ''; ?>">
    Shto shpallje +
</div>
<script>
document.getElementById("shtoShpalljeBtn").addEventListener("click", function () {
    const roli = this.getAttribute("data-roli");

    if (roli === "admin") {
        // Redirecto te shtoshpallje.php nëse është admin
        window.location.href = "shtoshpallje.php";
    } else if (roli === "user") {
        // Shfaq alert nëse është user
        alert("❌ Ju nuk jeni i autorizuar për këtë veprim.");
    } else {
        // Nëse nuk është kyçur fare (roli i zbrazët)
        alert("ℹ️ Ju duhet të kyçeni për të shtuar shpallje.");
        window.location.href = "index.php?mesazh=Ju+duhet+te+kyceni+per+te+shtuar+shpallje.&redirect=shtoShpallje.php";
    }
});
</script>


    <!-- Dropdown renditja -->
    <form method="GET" class="mb-4" style="margin-right:250px;">
        <label for="rendit">Rendit sipas:</label>
        <select name="rendit" id="rendit" onchange="this.form.submit()">
            <option value="" disabled <?= !isset($_GET['rendit']) || $_GET['rendit'] == '' ? 'selected' : '' ?>>Zgjidh renditjen</option>
            <option value="paga_desc" <?= (isset($_GET['rendit']) && $_GET['rendit'] == 'paga_desc') ? 'selected' : '' ?>>Paga (nga më e larta)</option>
            <option value="paga_asc" <?= (isset($_GET['rendit']) && $_GET['rendit'] == 'paga_asc') ? 'selected' : '' ?>>Paga (nga më e ulëta)</option>
            <option value="data_asc" <?= (isset($_GET['rendit']) && $_GET['rendit'] == 'data_asc') ? 'selected' : '' ?>>Data (më e hershmja)</option>
            <option value="data_desc" <?= (isset($_GET['rendit']) && $_GET['rendit'] == 'data_desc') ? 'selected' : '' ?>>Data (më e vonshmja)</option>
        </select>
    </form>
</div>

    <div class="container" id="card-container">
      
      <div class="row" >
      <?php
      require 'db.php';
    class Card {
        public $pozita;
        public $foto;
        public $dataShpalljes;
        public $kompania;
        public $kategoria;
        public $paga;
        public $lokacioni;
        public $pershkrimi;
        public $afatiAplikimit;
        public $onclick;

    
        function __construct($pozita,$foto, $dataShpalljes,$kompania,$kategoria, $paga,$lokacioni,$pershkrimi,$afatiAplikimit,$onclick) {
            $this->pozita = $pozita;
            $this ->foto = $foto;
            $this->dataShpalljes = $dataShpalljes;
            $this -> kompania = $kompania;
            $this -> kategoria = $kategoria;
            $this -> paga = $paga;
            $this -> lokacioni = $lokacioni;
            $this -> pershkrimi = $pershkrimi;
            $this -> afatiAplikimit = $afatiAplikimit;
            $this -> onclick = $onclick;


        }

        function shfaq() {
          echo '
<div class="col-md-4 ">
    <div class="card">
        <img src="' . $this->foto . '" class="card-img-top" alt="Pozitë e Lirë - ' .$this->pozita . '">
        <div class="card-body">
            <h4 class="card-title">Pozitë e Lirë - ' . $this->pozita . '</h4>
            <p class="date"><i class="fas fa-calendar-alt icon"></i>Shpallur: ' . $this->dataShpalljes . '</p>
            <p><span class="ikone" style="margin-left: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-journal" viewBox="0 0 16 16" style="color: #F4A261;">
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 
                    1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 
                    1v1H1V2a2 2 0 0 1 2-2"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 
                    1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 
                    0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 
                    0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                </svg></span> 
                <strong>Kompania:</strong> <span  style="margin-left: 0px;">' . $this->kompania . '</span>
            </p>
             <p><span class="ikone" style="margin-left: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-journal" viewBox="0 0 16 16" style="color: #F4A261;">
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 
                    1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 
                    1v1H1V2a2 2 0 0 1 2-2"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 
                    1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 
                    0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 
                    0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                </svg></span> 
                <strong>Kategoria:</strong> <span class="kategoria"  style="margin-left: 0px;">' . $this->kategoria . '</span>
            </p>
            <p><span class="ikone" style="margin-left: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cash-stack" viewBox="0 0 16 16">
                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 
                    0-4 2 2 0 0 0 0 4"/>
                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 
                    1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 
                    1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 
                    1-2-2z"/>
                </svg></span>
                <strong>Paga:</strong> <span class="paga" style="margin-left: 0px;">' . $this->paga . '</span>
            </p>
            <p><span class="ikone" style="margin-left: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-geo-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 
                    3.969V13.5a.5.5 0 0 1-1 
                    0V7.97A4 4 0 0 1 4 
                    3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 
                    1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 
                    0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 
                    3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 
                    0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 
                    0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 
                    0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 
                    13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 
                    14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 
                    1.957-.594a.5.5 0 0 1 .575.411"/>
                </svg></span> 
                <strong>Lokacioni:</strong> <span class="lokacioni" style="margin-left: 0px;">' . $this->lokacioni . '</span>
            </p>
            <p style="margin: 10px; size: 1em;height: 100px;">' . $this->pershkrimi . '</p>
            <p style="margin-left: 10px;"><strong>Afati i aplikimit:</strong> ' . $this->afatiAplikimit . '</p>
            <p id="afati" style="margin-left: 10px;"></p>
            <a href="#" class="btn btn-primary" style="margin-left: 215px; margin-bottom: 10px;" onclick="' . $this->onclick . '">Apliko Këtu</a>
           
        </div>
    </div>
</div>';
        }
    }

   


 

$cards = [];
$sql = "SELECT * FROM shpalljet WHERE afati >= CURDATE()";
$result = $con->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cards[] = new Card(
            $row['titulli'], $row['foto'], $row['data_publikimit'],
            $row['kompania'],$row['kategoria'], $row['paga'], $row['lokacioni'],
            $row['pershkrimi'], $row['afati'],
            "window.location.href='DetajetShpallje.php?id={$row['id']}'"
        );
    }
}

if (isset($_GET['rendit']) && !empty($cards)) {
    $rendit = $_GET['rendit'];
    usort($cards, function($a, $b) use ($rendit) {
        switch ($rendit) {
            case 'paga_desc': return (float)$b->paga - (float)$a->paga;
            case 'paga_asc': return (float)$a->paga - (float)$b->paga;
            case 'data_asc': return strtotime($a->dataShpalljes) - strtotime($b->dataShpalljes);
            case 'data_desc': return strtotime($b->dataShpalljes) - strtotime($a->dataShpalljes);
        }
        return 0;
    });
}
foreach ($cards as $card) {
    $card->shfaq();
}

    

    
?>
     
  </div>
 
  </main>
  <div id="chatContainer">
    <div id="chatHeader" style="background-color: #2a9d8f; color: white; padding: 8px 12px; display: flex; justify-content: space-between; align-items: center;">
  <span style="font-weight: bold;">Asistenti</span>
  <div>
    <button onclick="minimizeChat()" style="background:none; border:none; color:white; font-size:16px;">–</button>
    <button onclick="closeChat()" style="background:none; border:none; color:white; font-size:16px;">×</button>
  </div>
</div>
<div id="chatContent">
  <div class="chat-body">

    <div id="pyetjetSugjeruara" style="padding: 10px; border-bottom: 1px solid #ccc;">
  <p style="margin-bottom: 5px; font-weight: bold;">Pyetjet e zakonshme:</p>
  <div style="display: flex; flex-wrap: wrap; gap: 5px;">
    <button onclick="pergjigjeEPergatitur('Si të aplikoj?')">Si të aplikoj?</button>
    <button onclick="pergjigjeEPergatitur('Çfarë dokumentesh kërkohen?')">Çfarë dokumentesh kërkohen?</button>
    <button onclick="pergjigjeEPergatitur('A ka vende të lira për IT?')">A ka vende të lira për IT?</button>
    <button onclick="pergjigjeEPergatitur('Si mund të kontaktoj kompaninë?')">Si mund të kontaktoj kompaninë?</button>
  </div>
</div>
</div>

  <div id="chatLog"></div>
  <input type="text" id="chatInput" placeholder="Pyet diçka..." />
  </div>
</div>

  <script src="shpalljet.js"></script>
</div>
    <!-- Include footer -->
<?php include 'footer.php';?>

    <script scr="loginPopup.js"></script>
</body>
</html>