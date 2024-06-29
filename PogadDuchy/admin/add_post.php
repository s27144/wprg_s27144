<?php
session_start();
require_once '../includes/config.php';  // Dołączenie konfiguracji bazy danych
global $conn;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../includes/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $image_path = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = '../uploads/';
        $file_name = uniqid() . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (getimagesize($_FILES['image']['tmp_name']) !== false) {
            if (!file_exists($target_file)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $image_path = $target_file;
                } else {
                    echo "Wystąpił błąd podczas przesyłania pliku.";
                }
            } else {
                echo "Plik już istnieje.";
            }
        } else {
            echo "Plik nie jest obrazem.";
        }
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, content, image_path, author_id) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssi", $title, $content, $image_path, $_SESSION['user_id']);
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Wystąpił błąd: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Błąd przygotowania zapytania: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PogaDuchy - Nowy Post</title>
    <link rel="stylesheet" href="../css/stajl.css">
    <link rel="stylesheet" href="../css/style_footer.css">
</head>
<body>
<div class="container">
    <h1>Dodaj nowy post</h1>
    <form action="add_post.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Treść:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Wybierz obrazek:</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Dodaj post</button>
    </form>
</div>
<?php include '../footer.html'; ?>
</body>
</html>
