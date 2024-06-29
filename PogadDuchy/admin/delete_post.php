<?php
require_once '../includes/config.php'; // Dołącz konfigurację bazy danych
session_start();
global $conn;

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Pobranie informacji o tym, czy użytkownik jest administratorem
$query = "SELECT is_admin FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$is_admin = (int)$user['is_admin'] === 1;

// Sprawdzenie, czy użytkownik jest autorem posta
$query = "SELECT author_id FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

$is_author = ($post['author_id'] == $user_id);

if ($is_admin || $is_author) {
    $deleteQuery = "DELETE FROM posts WHERE id = $post_id";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: ../index.php"); // Przekieruj z powrotem do strony głównej po usunięciu
        exit;
    } else {
        echo "<p>Wystąpił błąd przy usuwaniu posta: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>Nie masz uprawnień do usunięcia tego posta.</p>";
    header("Refresh: 2; URL=../index.php");
    exit;
}
?>
