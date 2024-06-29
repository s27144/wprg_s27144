<?php
global $conn;
session_start();
require '../includes/config.php';  // Załaduj konfigurację połączenia z bazą danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Zapytanie SQL do wstawienia zgłoszenia do bazy danych
    $query = "INSERT INTO issues (username, email, description) VALUES (?, ?, ?)";

    // Przygotowanie zapytania
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sss", $username, $email, $description);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Zgłoszenie błędu zostało pomyślnie zapisane.";
        } else {
            $_SESSION['message'] = "Nie udało się zapisać zgłoszenia błędu.";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Błąd: " . $conn->error;
    }
    $conn->close();

    // Przekierowanie na stronę główną z opóźnieniem, aby uniknąć duplikacji zgłoszeń
    header("Refresh: 3; url=../index.php");
    exit;
} else {
    // Przekierowanie użytkownika z powrotem do formularza zgłoszeniowego
    header("Location: report_issue.php");
    exit;
}
?>
