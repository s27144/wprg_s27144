<?php
function fibonacci($n) {
    $fib = [0, 1];
    for ($i = 2; $i < $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    return $fib;
}

$N = 10; 
$ciagFibonacci = fibonacci($N);

echo "Nieparzyste elementy ciągu Fibonacciego dla N = $N:\n";
foreach ($ciagFibonacci as $indeks => $element) {
    if ($element % 2 !== 0) {
        echo "$indeks: $element\n";
    }
}
?>
