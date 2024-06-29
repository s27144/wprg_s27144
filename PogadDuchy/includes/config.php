<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'zaq1@WSX');
define('DB_NAME', 'pogaduchyDB');

/* Próba połączenia z bazą danych MySQL */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Sprawdzanie połączenia
if($conn === false) {
    die("BŁĄD: Nie można ustanowić połączenia z bazą danych: " . mysqli_connect_error());
}
?>
