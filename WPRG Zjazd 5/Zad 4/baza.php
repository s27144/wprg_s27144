<?php
$servername = "localhost:3306";
$username = "root";
$password = "zaq1@WSX";
$dbname = "mojabaza";

$polaczenie = new mysqli($servername, $username, $password, $dbname);

if ($polaczenie->connect_error) {
    die("Connection failed: " . $polaczenie->connect_error);
}
?>
