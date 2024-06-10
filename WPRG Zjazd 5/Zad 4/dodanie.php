<?php
global $polaczenie;
include 'baza.php';
include 'upper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];

    $zapytanie = "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES ('$marka', '$model', $cena, $rok, '$opis')";
    $polaczenie->query($zapytanie);

    header('Location: wszystkie.php');
    exit();
}
?>

<h2>Dodaj samochód</h2>
<form method="post">
    <label for="marka">Marka:</label>
    <input type="text" id="marka" name="marka" required><br>

    <label for="model">Model:</label>
    <input type="text" id="model" name="model" required><br>

    <label for="cena">Cena:</label>
    <input type="number" step="0.01" id="cena" name="cena" required><br>

    <label for="rok">Rok:</label>
    <input type="number" id="rok" name="rok" required><br>

    <label for="opis">Opis:</label>
    <textarea id="opis" name="opis" required></textarea><br>

    <button type="submit">Dodaj</button>
</form>

</body>
</html>
