<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik - Kalkulator WPRG s27144</title>
</head>
<body style="background-color: bisque;">
<center>
<h1>Wynik</h1>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["number1"];
    $num2 = $_POST["number2"];
    $operation = $_POST["operation"];

    switch ($operation) {
        case "dodawanie":
            $result = $num1 + $num2;
            echo "Wynik dodawania: $result";
            break;
        case "odejmowanie":
            $result = $num1 - $num2;
            echo "Wynik odejmowania: $result";
            break;
        case "mnozenie":
            $result = $num1 * $num2;
            echo "Wynik mnożenia: $result";
            break;
        case "dzielenie":
            if ($num2 != 0) {
                $result = $num1 / $num2;
                echo "Wynik dzielenia: $result";
            } else {
                echo "Nie można dzielić przez zero!";
            }
            break;
        default:
            echo "Nieznana operacja";
    }
}
?>
</center>
</body>
</html>