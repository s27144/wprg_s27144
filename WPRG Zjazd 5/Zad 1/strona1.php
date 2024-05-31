<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['karta_kredytowa'] = $_POST['karta_kredytowa'];
    $_SESSION['nazwa_usera'] = $_POST['nazwa_usera'];
    $_SESSION['liczba_ludzi'] = $_POST['liczba_ludzi'];
    header('Location: strona2.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Strona 1</title>
</head>
<body>
<h2>Podaj dane:</h2>
<form method="post" action="">
    <label for="karta_kredytowa">Numer karty kredytowej:</label>
    <input type="text" id="karta_kredytowa" name="karta_kredytowa" required><br>

    <label for="nazwa_usera">Uzupełnij dane zamawiającego:</label>
    <input type="text" id="nazwa_usera" name="nazwa_usera" required><br>

    <label for="liczba_ludzi">Ilość osób:</label>
    <input type="number" id="liczba_ludzi" name="liczba_ludzi" required><br>
    <br>
    <button type="submit">Dalej</button>
</form>
</body>
</html>