<?php
session_start();
if (!isset($_SESSION['liczba_ludzi'])) {
    header('Location: page1.php');
    exit();
}
$liczba_ludzi = $_SESSION['liczba_ludzi'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($x = 1; $x <= $liczba_ludzi; $x++) {
        $_SESSION["person_{$x}_name"] = $_POST["person_{$x}_name"];
        $_SESSION["person_{$x}_age"] = $_POST["person_{$x}_age"];
    }
    header('Location: strona3.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Strona 2</title>
</head>
<body>
<h2>Podaj dane osób</h2>
<form method="post" action="">
    <?php for ($x = 1; $x <= $liczba_ludzi; $x++): ?>
        <h2>Osoba <?php echo $x; ?></h2>
        <label for="person_<?php echo $x; ?>_name">Imię:</label>
        <input type="text" id="person_<?php echo $x; ?>_name" name="person_<?php echo $x; ?>_name" required><br>

        <label for="person_<?php echo $x; ?>_age">Wiek:</label>
        <input type="number" id="person_<?php echo $x; ?>_age" name="person_<?php echo $x; ?>_age" required><br>
    <?php endfor; ?>

    <button type="submit">Zapisz i kontynuuj</button>
</form>
</body>
</html>