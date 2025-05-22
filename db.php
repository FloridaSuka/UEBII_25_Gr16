<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "findyourway";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(!$con){
    echo "Db connection error.. ".mysqli_connect_error();
}

?>