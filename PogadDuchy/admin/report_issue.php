<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Zgłoś błąd</title>
    <link rel="stylesheet" href="../css/style_contact.css">
    <link rel="stylesheet" href="/css/style_footer.css">
</head>
<body>
<div class="contact-container">
    <h2>Zgłoś błąd</h2>
    <form action="submit_issue.php" method="post">
        <label>
            <input type="text" name="username" placeholder="Twoje imię" required>
        </label>
        <label>
            <input type="email" name="email" placeholder="Twój email" required>
        </label>
        <label>
            <textarea name="description" placeholder="Opis błędu" required></textarea>
        </label>
        <input type="submit" value="Wyślij zgłoszenie">
    </form>
</div>
<?php include '../footer.html'; ?>
</body>
</html>
