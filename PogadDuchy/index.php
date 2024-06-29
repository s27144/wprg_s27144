<?php
session_start(); // Start sesji
require_once 'includes/config.php'; // Połączenie z bazą danych
global $conn;
$query = "SELECT id, title, content, date_published FROM posts ORDER BY date_published DESC";
$result = mysqli_query($conn, $query);

?>
<?php if (isset($_SESSION['message'])): ?>
    <p style="text-align: center"><?php echo $_SESSION['message']; ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PogadDuchy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="stylesheet" href="css/style_footer.css">
</head>
<body>
<div class="container" >
    <div class="header" >
        <?php if (isset($_SESSION['user_id'])): ?>
            <span>Zalogowany jako: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <div>
                <a href="./includes/logout.php" class="btn btn-danger">Wyloguj</a>
                <a href="./admin/add_post.php" class="btn btn-primary">Dodaj nowy post</a>
            </div>
        <?php else: ?>
            <div>
                <a href="./includes/login.php" class="btn btn-primary">Zaloguj się</a>
                <a href="./includes/registration-form.php" class="btn btn-success">Zarejestruj się</a>
            </div>
        <?php endif; ?>
    </div>
    <h1>Witaj na blogu PogaDuchy!</h1><br>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($post = mysqli_fetch_assoc($result)): ?>
            <div class="post">
                <h2><a href="includes/post.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h2>
                <p><?php echo substr(htmlspecialchars($post['content']), 0, 50) . '...'; ?></p>
                <p>Opublikowano: <?php echo $post['date_published']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Brak postów do wyświetlenia.</p>
    <?php endif; ?>
</div>
<?php include 'footer.html'; ?>
</body>
</html>
