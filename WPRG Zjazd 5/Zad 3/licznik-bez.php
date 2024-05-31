<?php
session_start();
$max = 3;
if (isset($_COOKIE['licznik'])) {
    $licznik = $_COOKIE['licznik'];
} else {
    $licznik = 0;
}

if (!isset($_SESSION['sap'])) {
    $licznik++;
    $_SESSION['sap'] = true;
    setcookie('licznik', $licznik, time() + (30 * 24 * 60 * 60));
}
if ($licznik > $max) {
    echo "<h1>Przekroczyles liczbe dozwolonych wizyt strony.</h1>";
    echo "<p>Liczba odwiedzin: $licznik </p>";
} else {
    echo "<h1>Witamy na naszej stronie!</h1>";
    echo "<p>Liczba odwiedzin: $licznik </p>";
}
?>
<!doctype html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Licznik COOKIES bez odświeżania</title>
</head>
<body>

</body>
</html>

