<?php
require_once '../includes/config.php';
require_once '../includes/config.php';
?>
<!doctype html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style_log_reg.css">
    <link rel="stylesheet" href="/css/style_footer.css">
    <title>Rejestracja - PogaDuchy</title>
</head>
<body>
<div class="form-container">
    <h2 class="form-title">Rejestracja</h2>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Zarejestruj się">
        <a href="login.php" class="form-link">Masz już konto? Zaloguj się!</a>
    </form>
</div>
<?php include '../footer.html'; ?>
</body>
</html>
