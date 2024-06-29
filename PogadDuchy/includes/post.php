<?php
require_once '../includes/config.php'; // Dołącz konfigurację bazy danych
session_start();
global $conn;

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['user_id'] ?? 0;

// Pobranie danych postu
$query = "SELECT title, content, image_path, date_published, author_id FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "Post nie został znaleziony.";
    exit;
}

// Sprawdzenie, czy użytkownik jest administratorem
$adminQuery = "SELECT is_admin FROM users WHERE id = ?";
$adminStmt = $conn->prepare($adminQuery);
$adminStmt->bind_param("i", $user_id);
$adminStmt->execute();
$adminResult = $adminStmt->get_result();
$adminData = $adminResult->fetch_assoc();

$is_author_or_admin = ($user_id == $post['author_id']) || ($adminData && $adminData['is_admin'] == 1);

// Zapytania do nawigacji między postami
$prevQuery = "SELECT id FROM posts WHERE id < $post_id ORDER BY id DESC LIMIT 1";
$nextQuery = "SELECT id FROM posts WHERE id > $post_id ORDER BY id ASC LIMIT 1";
$prevResult = mysqli_query($conn, $prevQuery);
$nextResult = mysqli_query($conn, $nextQuery);
$prevId = mysqli_fetch_assoc($prevResult)['id'] ?? null;
$nextId = mysqli_fetch_assoc($nextResult)['id'] ?? null;

// Pobranie komentarzy
$commentsQuery = "SELECT author, comment, date_added FROM comments WHERE post_id = $post_id ORDER BY date_added DESC";
$commentsResult = mysqli_query($conn, $commentsQuery);
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="../css/style_post.css">
    <link rel="stylesheet" href="../css/style_footer.css">
</head>
<body>
<div class="container">
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    <?php if ($post['image_path']): ?>
        <!-- Dodanie onClick do obrazka -->
        <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Obrazek do posta" style="width:100%;" onclick="onClick(this)">
    <?php endif; ?>
    <p>Data publikacji: <?php echo $post['date_published']; ?></p>

    <?php if ($is_author_or_admin): ?>
        <div class="post-controls">
            <a href="../admin/edit_post.php?id=<?php echo $post_id; ?>" class="btn">Edytuj post</a>
            <a href="../admin/delete_post.php?id=<?php echo $post_id; ?>" onclick="return confirm('Czy na pewno chcesz usunąć ten post?');" class="btn">Usuń post</a>
        </div>
    <?php endif; ?>

    <div class="post-navigation">
        <?php if ($prevId): ?>
            <a href="post.php?id=<?php echo $prevId; ?>" class="btn">Poprzedni post</a>
        <?php endif; ?>
        <?php if ($nextId): ?>
            <a href="post.php?id=<?php echo $nextId; ?>" class="btn">Następny post</a>
        <?php endif; ?>
    </div>
</div>
<hr>
<div class="comments-section">
    <h2>Dodaj komentarz</h2>
    <form action="../admin/add_comment.php?id=<?php echo $post_id; ?>" method="post">
        <label for="author">Imię:</label>
        <input type="text" id="author" name="author"><br>
        <label for="comment">Komentarz:</label>
        <textarea id="comment" name="comment"></textarea><br>
        <button type="submit" class="btn">Dodaj komentarz</button>
    </form>
</div>
<hr>
<div class="comments-list">
    <h2>Komentarze</h2>
    <?php if (mysqli_num_rows($commentsResult) > 0): ?>
        <?php while ($comment = mysqli_fetch_assoc($commentsResult)): ?>
            <div class="comment">
                <p><strong><?php echo htmlspecialchars($comment['author']); ?></strong> (<?php echo $comment['date_added']; ?>)</p>
                <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Brak komentarzy. Bądź pierwszy!</p>
    <?php endif; ?>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01" alt="<?php echo htmlspecialchars($post['title']); ?>">
    <div id="caption"></div>
</div>
<script src="../js/lightbox.js"></script>
<?php include '../footer.html'; ?>
</body>
</html>
