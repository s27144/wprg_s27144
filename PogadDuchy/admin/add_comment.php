<?php
require_once '../includes/config.php'; // Dołącz konfigurację bazy danych
session_start();
global $conn;

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    $author = !empty($_POST['author']) ? mysqli_real_escape_string($conn, $_POST['author']) : 'Gość';
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $insertQuery = "INSERT INTO comments (post_id, author, comment, date_added) VALUES ($post_id, '$author', '$comment', NOW())";
    if(mysqli_query($conn, $insertQuery)){
        header("Location: ../includes/post.php?id=$post_id"); // Przekieruj z powrotem do postu
        exit;
    } else {
        echo "<p>Wystąpił błąd przy dodawaniu komentarza.</p>";
    }
}
?>
