<?php

function gap($g, $m, $n) {
    $previous = 0;
    
    while($m++ <= $n) {
        if (is_prime($m)) {
            if (abs($previous - $m) == $g) {
                return [$previous, $m];
                break;
            }
            $previous = $m;
        }
    }
    return NULL;
}

function is_prime($number) {
    $n = abs($number);
    $i = 2;
    while ($i <= sqrt($n)) {
        if ($n % $i == 0) {
            return false;
        }
        $i++;
    }
    return true;
}

//echo implode(' ', $getPrimes(110)) . "\n";
//echo print_r($getPrimes(110), true) . "\n";
echo print_r(gap(2,100,110), true) . "\n";
echo print_r(gap(4,100,110), true) . "\n";
echo print_r(gap(6,100,110), true) . "\n";
echo print_r(gap(8,300,400), true) . "\n";
echo print_r(gap(10,300,400), true) . "\n";
//echo print_r(gap(4,257292,257298), true) . "\n";
echo print_r(gap(4,256962,257298), true) . "\n";



?>