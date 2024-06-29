<?php
global $conn;
session_start();
require '../includes/config.php';  // Załaduj konfigurację połączenia z bazą danych

$message = "";  // Inicjalizacja zmiennej na komunikaty

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
            $_SESSION['message'] = "Zgłoszenie kontaktu zostało pomyślnie zapisane.";
        } else {
            $_SESSION['message'] = "Nie udało się zapisać zgłoszenia kontaktu. Spróbuj ponownie później.";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Błąd: " . $conn->error;
    }
    $conn->close();

    header("Location: contact.php");  // Przekieruj z powrotem na tę samą stronę, aby odświeżenie nie duplikowało zgłoszeń
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);  // Usuń komunikat z sesji, aby nie wyświetlał się ponownie po odświeżeniu
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <link rel="stylesheet" href="/css/style_contact.css">
    <link rel="stylesheet" href="/css/style_footer.css">
</head>
<body>
<div class="contact-container">
    <h2>Skontaktuj się z nami</h2>
    <p>Jeśli masz jakiekolwiek pytania, skorzystaj z poniższego formularza, aby wysłać wiadomość do administratora.</p>
    <?php if ($message) echo "<p>$message</p>"; ?>  <!-- Wyświetlenie komunikatu -->
    <form action="contact.php" method="post">
        <input type="text" name="username" placeholder="Twoje imię" required>
        <input type="email" name="email" placeholder="Twój email" required>
        <textarea name="description" placeholder="Twoja wiadomość" required></textarea>
        <input type="submit" value="Wyślij">
    </form>
</div>
<?php include '../footer.html'; ?>
</body>
</html>
