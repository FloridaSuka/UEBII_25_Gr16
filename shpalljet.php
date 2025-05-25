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
</head>
<body>
  
   
    <main>
      <div id="header-container"></div>
    <script src="navHandler.js"></script>
    <?php include 'nav.php'; ?>
  </div>
    <section>
      <input style = "margin-top: 20px;" type="text" id="kerko" onkeyup="kerko()" placeholder="Kerko..">
     

      <br>
      <div class="dropdown"  >
        <button onclick="toggleDropdown(event, 'myDropdown')" class="dropbtn">Qytetet <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;" ></span></button>
        <div id="myDropdown" class="dropdown-content">
          <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
             
          <a href="#" onclick="filterByCity(this)">Prishtin&#235;</a>
          <a href="#" onclick="filterByCity(this)">Pej&#235;</a>
          <a href="#" onclick="filterByCity(this)">Podujev&#235;</a>
          <a href="#" onclick="filterByCity(this)">Mitrovic&#235;</a>
          <a href="#" onclick="filterByCity(this)">Fush&#235; Kosov&#235;</a> 
          <a href="#" onclick="filterByCity(this)">Klin&#235;</a>
          <a href="#" onclick="filterByCity(this)">Viti</a>
          <a href="#" onclick="filterByCity(this)">De&#231;an</a>
          <a href="#" onclick="filterByCity(this)">Gjilan</a>
          <a href="#" onclick="filterByCity(this)">Prizren</a>
          <a href="#" onclick="filterByCity(this)">Vushtrri</a>
          <a href="#" onclick="filterByCity(this)">Malishev&#235;</a>
          <a href="#" onclick="filterByCity(this)">Drenas</a>
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
          <a href="#1" onclick="filterByCategory(this)">Transport</a>
         
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
        public $kategoria;
        public $paga;
        public $lokacioni;
        public $pershkrimi;
        public $afatiAplikimit;
        public $onclick;

    
        function __construct($pozita,$foto, $dataShpalljes,$kategoria, $paga,$lokacioni,$pershkrimi,$afatiAplikimit,$onclick) {
            $this->pozita = $pozita;
            $this ->foto = $foto;
            $this->dataShpalljes = $dataShpalljes;
            $this -> kategoria = $kategoria;
            $this -> paga = $paga;
            $this -> lokacioni = $lokacioni;
            $this -> pershkrimi = $pershkrimi;
            $this -> afatiAplikimit = $afatiAplikimit;
            $this -> onclick = $onclick;


        }

        function shfaq() {
          echo '
<div class="col-md-4">
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
                <strong>Kategoria:</strong> <span class="kategoria" style="margin-left: 0px;">' . $this->kategoria . '</span>
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

   


 

    $result = $con->query("SELECT * FROM shpalljet ORDER BY data_publikimit DESC");
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $pozita = $row['titulli'];
            $foto = $row['foto']; // merre foton nga databaza
            $data = $row['data_publikimit'];
            $kategoria = $row['kompania'];
            $paga = $row['paga'];
            $lokacioni = $row['lokacioni'];
            $pershkrimi = $row['pershkrimi'];
            $afati = $row['afati'];
            $onclick = "window.location.href='DetajetShpallje.php?id=$id'";
            
    
            $onclick = "window.location.href='DetajetShpallje.php?id={$row['id']}'";

            
            $c = new Card($pozita, $foto, $data, $kategoria, $paga, $lokacioni, $pershkrimi, $afati, $onclick);
            $c->shfaq();
        }
    }
    

    
?><script>
function shkoTeFaqja1() { window.location.href = "DetajetMesuese.php"; }
function shkoTeFaqja2() { window.location.href = "DetajetArkitekt.php"; }
function shkoTeFaqja3() { window.location.href = "DetajetInxhinier.php"; }
function shkoTeFaqja4() { window.location.href = "DetajetIT.php"; }
function shkoTeFaqja5() { window.location.href = "DetajetKuzhinier.php"; }
function shkoTeFaqja6() { window.location.href = "DetajetShofer.php"; }
function shkoTeFaqja7() { window.location.href = "DetajetStomatolog.php"; }
function shkoTeFaqja8() { window.location.href = "DetajetFotograf.php"; }
function shkoTeFaqja9() { window.location.href = "DetajetKontabilist.php"; }
function shkoTeFaqja10() { window.location.href = "DetajetSoftware.php"; }
function shkoTeFaqja11() { window.location.href = "DetajetMarketing.php"; }
function shkoTeFaqja12() { window.location.href = "DetajetAvokat.php"; }
</script>
     
  </div>
 
  </main>
  <script src="shpalljet.js"></script>
</div>
    <!-- Include footer -->
<?php include 'footer.php';?>

    <script scr="loginPopup.js"></script>
</body>
</html>