<?php
$servername = "localhost";
$username = "postgres";
$password = "123456";
$dbname = "projekti";
$port = "5432";

$conn = pg_connect("host=$servername port=$port dbname=$dbname user=$username password=$password");
if (!$conn) {
    die("Lidhja me bazën e të dhënave dështoi: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $mosha = $_POST['mosha'];
    
    if (!empty($emri) && !empty($mbiemri) && !empty($mosha)) {
        $query = "INSERT INTO perdoruesit (emri, mbiemri, mosha) VALUES ($1, $2, $3)";
        $result = pg_query_params($conn, $query, array($emri, $mbiemri, $mosha));
        
        if ($result) {
            echo "Të dhënat u shtuan me sukses!";
        } else {
            echo "Gabim në shtimin e të dhënave: " . pg_last_error($conn);
        }
    } else {
        echo "Ju lutemi plotësoni të gjitha fushat!";
    }
}
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma e Regjistrimit</title>
    <script>
        function validateForm() {
            let emri = document.forms["formaRegjistrimit"]["emri"].value;
            let mbiemri = document.forms["formaRegjistrimit"]["mbiemri"].value;
            let mosha = document.forms["formaRegjistrimit"]["mosha"].value;
            
            if (emri == "" || mbiemri == "" || mosha == "") {
                alert("Ju lutemi plotësoni të gjitha fushat!");
                return false;
            }
        }
    </script>
</head>
<body>
    <h2>Regjistrimi</h2>
    <form name="formaRegjistrimit" action="" method="POST" onsubmit="return validateForm()">
        <label for="emri">Emri:</label>
        <input type="text" id="emri" name="emri"><br><br>
        
        <label for="mbiemri">Mbiemri:</label>
        <input type="text" id="mbiemri" name="mbiemri"><br><br>
        
        <label for="mosha">Mosha:</label>
        <input type="number" id="mosha" name="mosha" min="1"><br><br>
        
        <input type="submit" name="submit" value="Regjistrohu">
    </form>
</body>
</html>