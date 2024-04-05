<?php
$owoce = ["jablko", "banan", "pomarancza"];

foreach ($owoce as $owoc) {
    $dlugosc = strlen($owoc);
    $odwroconyOwoc = '';
    for ($i = $dlugosc - 1; $i >= 0; $i--) {
        $odwroconyOwoc .= $owoc[$i];
    }
    echo $odwroconyOwoc . "\n";

    if (strtolower(substr($owoc, 0, 1)) === 'p') {
        echo "$owoc zaczyna się od litery 'p'\n";
    }else{
		echo "$owoc nie zaczyna sie od litery 'p'\n";
	}
		
}
?>