<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie rezerwacji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f2f1;
            color: #1565c0;
            padding: 20px;
        }
        h2 {
            color: #0d47a1;
        }
        p {
            margin-bottom: 10px;
        }
        strong {
            color: #01579b;
        }
    </style>
</head>
<body>
<h2>Podsumowanie rezerwacji</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba_ludzi = $_POST["liczba_ludzi"];
    for ($i = 0; $i < $liczba_ludzi; $i++) {
        $first_name = $_POST["first_name"][$i];
        $last_name = $_POST["last_name"][$i];
        $address = $_POST["address"][$i];
        $credit_card = $_POST["credit_card"][$i];
        $email = $_POST["email"][$i];
        $arrival_date = $_POST["arrival_date"][$i];
        $arrival_time = $_POST["arrival_time"][$i];
        $departure_date = $_POST["departure_date"][$i];
        $child_bed = isset($_POST["child_bed_" . $i]) ? "Tak" : "Nie";
        $amenities = isset($_POST["amenities_" . $i]) ? implode(", ", $_POST["amenities_" . $i]) : "Brak";

        echo "<h3>Osoba " . ($i + 1) . "</h3>";
        echo "<p><strong>Imię:</strong> $first_name</p>";
        echo "<p><strong>Nazwisko:</strong> $last_name</p>";
        echo "<p><strong>Adres:</strong> $address</p>";
        echo "<p><strong>Nr karty kredytowej:</strong> $credit_card</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Data przyjazdu:</strong> $arrival_date</p>";
        echo "<p><strong>Godzina przyjazdu:</strong> $arrival_time</p>";
        echo "<p><strong>Data wyjazdu:</strong> $departure_date</p>";
        echo "<p><strong>Dostawka dla dziecka:</strong> $child_bed</p>";
        echo "<p><strong>Udogodnienia:</strong> $amenities</p>";
    }
}
?>
</body>
</html>
