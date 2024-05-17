<?php
$plik = 'licznik.txt';

if (!file_exists($plik)) {file_put_contents($plik, '1');}

$cnt = intval(file_get_contents($plik));
$cnt++;
file_put_contents($plik, $cnt);
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zliczanie odwiedzin</title>
</head>
<body>
<p>Liczba odwiedzin na stronie: <?php echo $cnt; ?></p>
</body>
</html>