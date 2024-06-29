<?php
session_start();
global $conn;
require '../includes/config.php';  // Załaduj konfigurację połączenia z bazą danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Zapytanie SQL do wstawienia zgłoszenia do bazy danych
    $query = "INSERT INTO contact (username, email, description) VALUES (?, ?, ?)";

    // Przygotowanie zapytania
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sss", $username, $email, $description);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Zgłoszenie kontaktu zostało pomyślnie zapisane.";
            $stmt->close();
            $conn->close();
            // Dodanie przekierowania z opóźnieniem
            header("refresh:3;url=../index.php");
            exit;
        } else {
            echo "Nie udało się zapisać zgłoszenia kontaktu. Spróbuj ponownie później.";
        }
        $stmt->close();
    } else {
        echo "Błąd: " . $conn->error;
    }
    $conn->close();
} else {
    // Przekierowanie użytkownika z powrotem do formularza, jeśli metoda nie jest POST
    header("Location: contact.php");
    exit;
}
?>
