<?php
session_start();

// Ustaw czas życia sesji na 15 minut.
$expireAfter = 15;

// Sprawdź, czy istnieje timestamp ostatniej aktywności.
if (isset($_SESSION['last_action'])) {
    // Oblicz różnicę czasu od ostatniej aktywności.
    $secondsInactive = time() - $_SESSION['last_action'];

    // Przelicz na minuty.
    $expireAfterSeconds = $expireAfter * 60;

    // Sprawdź, czy minęło już 15 minut.
    if ($secondsInactive >= $expireAfterSeconds) {
        // Usuń wszystkie zmienne sesyjne.
        session_unset();

        // Zniszcz sesję.
        session_destroy();

        // Przekierowanie do strony logowania.
        header("Location: login.php");
        exit;
    }
}

// Zaktualizuj timestamp ostatniej aktywności.
$_SESSION['last_action'] = time();

require 'config.php';  // Upewnij się, że ścieżka do config.php jest prawidłowa
global $conn;

$error = ''; // Inicjalizacja zmiennej błędu

// Sprawdzanie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT id, password_hash, is_admin FROM users WHERE username = '$username' OR email = '$username'");

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password_hash'])) {
            // Ustawienie sesji
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['username'] = $username;  // Zapisanie nazwy użytkownika w sesji
            header("Location: ../index.php"); // Przekierowanie na stronę główną
            exit;
        } else {
            echo '<script>alert("Nieprawidłowe hasło")</script>';
        }
    } else {
        echo '<script>alert("Użytkownik nie istnieje. Spróbuj ponownie, bądź zarejestruj nowe konto!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Logowanie - PogaDuchy</title>
    <link rel="stylesheet" href="/css/style_log_reg.css">
    <link rel="stylesheet" href="/css/style_footer.css">
</head>
<body>
<?php if (!empty($error)): ?>
    <p><?php echo $error; ?> <a href="login.php">Spróbuj ponownie</a></p>
<?php endif; ?>

<div class="form-container">
    <h2 class="form-title">Logowanie</h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Zaloguj się">
        <a href="registration-form.php" class="form-link">Nie masz konta? Zarejestruj się!</a>
    </form>
</div>
<?php include '../footer.html'; ?>
</body>
</html>
