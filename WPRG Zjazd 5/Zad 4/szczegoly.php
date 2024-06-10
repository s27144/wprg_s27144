<?php
global $polaczenie;
include 'baza.php';
include 'upper.php';

$id = $_GET['id'];

$zapytanie = "SELECT * FROM samochody WHERE id = $id";
$wynik = $polaczenie->query($zapytanie);
$row = $wynik->fetch_assoc();
?>

<h2>Szczegóły samochodu</h2>
<p>ID: <?php echo $row['id']; ?></p>
<p>Marka: <?php echo $row['marka']; ?></p>
<p>Model: <?php echo $row['model']; ?></p>
<p>Cena: <?php echo $row['cena']; ?></p>
<p>Rok: <?php echo $row['rok']; ?></p>
<p>Opis: <?php echo $row['opis']; ?></p>

<a href="wszystkie.php">Powrót do listy samochodów</a>

</body>
</html>
