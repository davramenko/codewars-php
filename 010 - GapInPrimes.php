<?php

function gap($g, $m, $n) {
	//$getPrimes = function ($maxNum) {
	//	$candidates = array_fill(0, $maxNum, true);
	//	$maxi = intval(floor(sqrt($maxNum)));
	//	for ($i = 2; $i <= $maxi; $i++) {
	//		if ($candidates[$i]) {
	//			$sqi = $i * $i;
	//			for ($k = 0; ; $k++) {
	//				$j = $sqi + $i * $k;
	//				if ($j > $maxNum) break;
	//				$candidates[$j] = false;
	//			}
	//		}
	//	}
	//	$primes = [];
	//	for ($i = 2; $i < count($candidates); $i++) {
	//		if ($candidates[$i]) {
	//			$primes[] = $i;
	//		}
	//	}
	//	return $primes;
	//};

	$getPrimes = function ($maxNum) {
		$candidates = str_pad('', $maxNum, '1');
		//$candidates = array_fill(0, $maxNum, true);
		$maxi = intval(floor(sqrt($maxNum)));
		for ($i = 2; $i <= $maxi; $i++) {
			if ($candidates[$i]) {
				$sqi = $i * $i;
				for ($k = 0; ; $k++) {
					$j = $sqi + $i * $k;
					if ($j > $maxNum) break;
					//$candidates[$j] = false;
					$candidates[$j] = '0';
				}
			}
		}
		$primes = [];
		//for ($i = 2; $i < count($candidates); $i++) {
		for ($i = 2; $i < strlen($candidates); $i++) {
			if ($candidates[$i]) {
				$primes[] = $i;
			}
		}
		return $primes;
	};


	//$getPrimes = function($maxNum) {
	//	$primes = array();
	//	$primes[] = 2;
	//	for ($i = 3; $i <= $maxNum; $i += 2) {
	//		$isPrime = true;
	//		for ($j = 0; $j < count($primes); $j++) {
	//			if (($i % $primes[$j]) === 0) {
	//				$isPrime = false;
	//				break;
	//			}
	//		}
	//		if ($isPrime)
	//			$primes[] = $i;
	//	}
	//	return $primes;
	//};
	//$getPrimes = function ($finish) {
	//	$number = 2;
	//	$range = range($number,$finish);
	//	$primes = array_combine($range,$range);
	//	while ($number * $number < $finish) {
	//		for ($i = $number; $i <= $finish; $i += $number) {
	//			if ($i == $number)
	//				continue;
	//			unset($primes[$i]);
	//		}
	//		$number = next($primes);
	//	}
	//	return array_values($primes);
	//};

	//$getPrimes = function ($limit) {
	//	$sieve[$limit] = 0;
	//	for ($i = 0; $i < $limit; $i++)
	//		$sieve[$i] = false;
	//
	//	for ($x = 1; $x * $x < $limit; $x++) {
	//		for ($y = 1; $y * $y < $limit; $y++) {
	//
	//			$n = (4 * $x * $x) + ($y * $y);
	//			if ($n <= $limit && ($n % 12 == 1 || $n % 12 == 5))
	//				$sieve[$n] ^= true;
    //
	//			$n = (3 * $x * $x) + ($y * $y);
	//			if ($n <= $limit && $n % 12 == 7)
	//				$sieve[$n] ^= true;
    //
	//			$n = (3 * $x * $x) - ($y * $y);
	//			if ($x > $y && $n <= $limit && $n % 12 == 11)
	//				$sieve[$n] ^= true;
	//		}
	//	}
    //
	//	for ($r = 5; $r * $r < $limit; $r++) {
	//		if ($sieve[$r]) {
	//			for ($i = $r * $r; $i < $limit; $i += $r * $r)
	//				$sieve[$i] = false; 
	//		} 
	//	} 
  	//	$primes = array();
	//	for ($a = 5; $a < $limit; $a++)
	//		if ($sieve[$a])
	//			$primes[] = $a;
	//	return $primes;
	//};

	$primes = $getPrimes($n);
	for ($i = 1; $i < count($primes); $i++) {
		if ($primes[$i - 1] < $m)
			continue;
		if (($primes[$i] - $primes[$i - 1]) === $g)
			return array($primes[$i - 1], $primes[$i]);
	}
	return null;
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