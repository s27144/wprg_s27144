<?php
$max = 3;

if (isset($_COOKIE['licznik'])) {
    $licznik = $_COOKIE['licznik'] + 1;
} else {
    $licznik = 1;
}
setcookie('licznik', $licznik, time() + (30 * 24 * 60 * 60));
if ($licznik > $max) {
    echo "<h2>Przekroczyles liczbe dozwolonych wizyt strony.</h2>";
    echo "<p>Liczba odwiedzin: $licznik </p>";
} else {
    echo "<h2>Witamy na naszej stronie!</h2>";
    echo "<p>Liczba odwiedzin: $licznik </p>";
}
?>
<!doctype html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Licznik COOKIES</title>
</head>
<body>

</body>
</html>
