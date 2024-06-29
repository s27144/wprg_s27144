<?php
session_start();
require_once '../includes/config.php'; // Dołącz konfigurację bazy danych
global $conn;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../includes/login.php");
    exit;
}

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'];

// Pobranie danych postu do edycji i sprawdzenie, czy użytkownik jest autorem lub administratorem - /zrobione sam + potem skrócone przez gpt
$query = "SELECT p.title, p.content, p.author_id, u.is_admin FROM posts p JOIN users u ON u.id = ? WHERE p.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Nie znaleziono posta.";
    exit;
}

$is_admin = (int)$post['is_admin'] === 1;
$is_author = ($post['author_id'] == $user_id);

if (!$is_admin && !$is_author) {
    echo "Nie masz uprawnień do edytowania tego posta.";
    exit;
}

// Aktualizacja postu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $updateQuery = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $updateQuery->bind_param("ssi", $title, $content, $post_id);
    if ($updateQuery->execute()) {
        echo "Post został zaktualizowany.";
        header("Location: ../includes/post.php?id=$post_id"); // Przekierowanie do zaktualizowanego posta
        exit;
    } else {
        echo "Wystąpił błąd: " . $updateQuery->error;
    }
}

include '../footer.html';
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Post</title>
    <link rel="stylesheet" href="../css/style_post.css">
    <link rel="stylesheet" href="../css/style_footer.css">
</head>
<body>
<div class="container">
    <h1>Edytuj Post</h1>
    <form action="edit_post.php?id=<?php echo $post_id; ?>" method="post">
        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Treść:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <button type="submit" class="btn">Zapisz zmiany</button>
    </form>
</div>
</body>
</html>
