<?php
require '../includes/config.php'; // Upewnij się, że ta ścieżka jest poprawna
session_start(); // Rozpocznij sesję, jeśli planujesz używać zmiennych sesyjnych
global $conn;

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Sprawdzenie, czy użytkownik lub email już istnieje
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
if (!$stmt) {
    echo "Błąd przygotowania zapytania: " . $conn->error;
    exit;
}
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo '<script>alert("Użytkownik o takim loginie lub adresie e-mail już istnieje."); window.location.href = "registration-form.php";</script>';
    exit;
}
$stmt->close(); // Zamknij pierwsze zapytanie przed otwarciem nowego

// Wprowadzenie nowego użytkownika do bazy danych
$stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
if (!$stmt) {
    echo "Błąd przygotowania zapytania: " . $conn->error;
    exit;
}
$stmt->bind_param("sss", $username, $email, $password_hash);
if ($stmt->execute()) {
    // Jeśli zalogowanie jest konieczne bezpośrednio po rejestracji, można dodać użytkownika do sesji tutaj
    echo "<script>alert('Rejestracja zakończona sukcesem.'); window.location.href = '../includes/login.php';</script>";
    exit;
} else {
    echo "Błąd przy dodawaniu użytkownika: " . $stmt->error;
}
$stmt->close();
?>
