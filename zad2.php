<?php
function czyPierwsza($liczba) {
    if ($liczba <= 1) {
        return false;
    }
    for ($i = 2; $i * $i <= $liczba; $i++) {
        if ($liczba % $i == 0) {
            return false;
        }
    }
    return true;
}

function liczbyPierwsze($start, $koniec) {
    for ($i = $start; $i <= $koniec; $i++) {
        if (czyPierwsza($i)) {
            echo $i . "\n";
        }
    }
}

$start = 0;
$koniec = 100;
echo "Liczby pierwsze w przedziale od $start do $koniec:\n";
liczbyPierwsze($start, $koniec);
?>
