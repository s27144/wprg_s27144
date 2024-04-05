<?php
$tekst = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
galley of type and scrambled it to make a type specimen book. It has survived not only five
centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
and more recently with desktop publishing software like Aldus PageMaker including versions of
Lorem Ipsum.";

$tablicaSlow = explode(' ', $tekst);

for ($i = 0; $i < count($tablicaSlow); $i++) {
    $slowo = $tablicaSlow[$i];
    $ostatniZnak = substr($slowo, -1);
    if (in_array($ostatniZnak, [',', '.', "'", '"', '!', '?'])) {
        $tablicaSlow[$i] = rtrim($slowo, ",.'\"!?");
        $tablicaSlow[$i + 1] = ltrim($tablicaSlow[$i + 1], ",.'\"!?");
    }
}


$tablicaAsocjacyjna = [];
for ($i = 0; $i < count($tablicaSlow) - 1; $i += 2) {
    $klucz = $i + 1;
    $tablicaAsocjacyjna[$tablicaSlow[$i]] = $tablicaSlow[$klucz];
}


foreach ($tablicaAsocjacyjna as $klucz => $wartosc) {
    echo "$klucz => $wartosc\n";
}
?>
