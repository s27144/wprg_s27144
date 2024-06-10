<?php
global $polaczenie;
include 'baza.php';
include 'upper.php';

$zapytanie = "SELECT * FROM samochody ORDER BY rok DESC";
$wynik = $polaczenie->query($zapytanie);
?>

<h2>Wszystkie samochody</h2>
<table border="10"; style="border-style: groove; text-align: center">
    <tr>
        <th>ID</th>
        <th>Marka</th>
        <th>Model</th>
        <th>Cena</th>
        <th>Akcje</th>
    </tr>
    <?php while ($row = $wynik->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['marka']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['cena']; ?></td>
            <td><a href="szczegoly.php?id=<?php echo $row['id']; ?>">Szczegóły</a></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
