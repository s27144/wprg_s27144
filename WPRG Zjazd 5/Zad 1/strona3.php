<?php
session_start();
if (!isset($_SESSION['karta_kredytowa'])) {
    header('Location: page1.php');
    exit();
}
$liczba_ludzi = $_SESSION['liczba_ludzi'];
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Strona 3</title>
</head>
<body>
<h2>Podsumowanie</h2>
<p>Dane zamawiającego: <?php echo htmlspecialchars($_SESSION['nazwa_usera']); ?></p>
<p>Ilość osób: <?php echo htmlspecialchars($liczba_ludzi); ?></p>
<p>Numer karty kredytowej: <?php echo htmlspecialchars($_SESSION['karta_kredytowa']); ?></p>
<?php for ($x = 1; $x <= $liczba_ludzi; $x++): ?>
    <h3>Osoba <?php echo $x; ?></h3>
    <p>Imię: <?php echo htmlspecialchars($_SESSION["person_{$x}_name"]); ?></p>
    <p>Wiek: <?php echo htmlspecialchars($_SESSION["person_{$x}_age"]); ?></p>
<?php endfor; ?>

<a href="strona1.php">Powrót do początku</a>
</body>
</html>