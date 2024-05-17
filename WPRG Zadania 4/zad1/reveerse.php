<!DOCTYPE html>
<html>
<head>
    <title>Odwrocona kolejnosc</title>
</head>
<body>
<h1>Dodaj wybrany plik - tekstowy:</h1>
<form action="reveerse.php" method="post" enctype="multipart/form-data">
    <input type="file" name="toReverse" id="toReverse">
    <br><br><br>
    <input type="submit" value="Odwróć kolejność">
</form>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["toReverse"])) {
    $plik = $_FILES["toReverse"];

    if ($plik["error"] == UPLOAD_ERR_OK) {
        $nazwa = $plik["tmp_name"];
        $lines = file($nazwa);
        $reversed_lines = array_reverse($lines);

        $odwrocony_plik = "odwrocona-kolejnosc_" . $plik["name"];
        file_put_contents($odwrocony_plik, implode("", $reversed_lines));

        echo "<p>Konwersja zrobiona, pobierz  <a href='$odwrocony_plik' download>tutaj:</a>.</p>";
    } else {
        echo "<p>Wystąpił błąd, sprobuj ponownie</p>";
    }
}
?>