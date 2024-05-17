<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odnosniki</title>
</head>
<body>
<h3>Lista odnośników:</h3>
<ol>
    <?php
    $file = 'adresy.txt';
    if (file_exists($file)) {
        $text = fopen($file, "r"); //plik w reading mode
        while (($linia = fgets($text)) !== false) {
            $czesci = explode(';', $linia);
            if (count($czesci) == 2) {
                $url = trim($czesci[0]);
                $desc = trim($czesci[1]);
                echo "<li><a href='$url'>$desc</a></li>";
            }
        }
        fclose($text);
    } else { echo "Brak pliku z danymi"; }
    ?>
</ol>
</body>
</html>