<?php

// Common Denominators
// https://ru.wikipedia.org/wiki/%D0%9D%D0%B0%D0%B8%D0%BC%D0%B5%D0%BD%D1%8C%D1%88%D0%B5%D0%B5_%D0%BE%D0%B1%D1%89%D0%B5%D0%B5_%D0%BA%D1%80%D0%B0%D1%82%D0%BD%D0%BE%D0%B5

function convertFrac($lst){
	if (count($lst) == 0)
		return "";
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
	$max_denom = array_reduce(array_map(function($el) {
		return $el[1];
	}, $lst), function($carry, $item) {
		if ($carry < $item)
			return $item;
		return $carry;
	});
	//echo "Max denominator: $max_denom\n";
	$primes = $getPrimes($max_denom + 1);
	//echo print_r($primes, true) . "\n";
	$factorize = function($num) use ($primes) {
		$res = array();
		foreach ($primes as $i => $prime) {
			$cnt = 0;
			while ($num > 1) {
				if (($num % $prime) === 0) {
					$num = intval($num / $prime);
					$cnt++;
				} else {
					break;
				}
			}
			if ($cnt > 0)
				$res[$prime] = $cnt;
		}
		return $res;
	};
	$simplified_lst = array_map(function ($item) use ($factorize) {
		$fnum = $factorize($item[0]);
		$fdenom = $factorize($item[1]);
		$cfactors = array();
		foreach ($fnum as $prime => $pow) {
			if (array_key_exists($prime, $fdenom)) {
				$cfactors[$prime] = ($pow <= $fdenom[$prime]) ? $pow : $fdenom[$prime];
			}
		}
		$div = array_reduce(array_keys($cfactors), function($carry, $prime) use ($cfactors) {
			return $carry * pow($prime, $cfactors[$prime]);
		}, 1);
		return array(intval($item[0] / $div), intval($item[1] / $div));
	}, $lst);
	$fdenoms = array_map(function($item) use ($factorize) {
		return $factorize($item[1]);
	}, $simplified_lst);
	//echo print_r($fdenoms, true) . "\n";
	$lcm_factors = array();
	foreach ($fdenoms as $factors) {
		foreach ($factors as $prime => $pow) {
			if (array_key_exists($prime, $lcm_factors)) {
				if ($pow > $lcm_factors[$prime])
					$lcm_factors[$prime] = $pow;
			} else {
				$lcm_factors[$prime] = $pow;
			}
		}
	}
	//echo print_r($lcm_factors, true) . "\n";
	$lcd = array_reduce(array_keys($lcm_factors), function($carry, $prime) use ($lcm_factors) {
		return $carry * pow($prime, $lcm_factors[$prime]);
	}, 1);
	//echo "LCD: $lcd\n";
	$res =  implode("", array_map(function($item) use ($lcd) {
		$num = intval($item[0] * $lcd / $item[1]);
		return "($num,$lcd)";
	}, $simplified_lst));
	return $res;
}

//$lst = [ [1, 2], [1, 3], [1, 4] ];
//echo "[" . convertFrac($lst) . "]\n"; // "(6,12)(4,12)(3,12)"
//$lst = [ [69, 130], [87, 1310], [3, 4] ];
//echo "[" . convertFrac($lst) . "]\n"; // "(18078,34060)(2262,34060)(25545,34060)"
//$lst = [  ];
//echo "[" . convertFrac($lst) . "]\n"; // ""
//$lst = [ [77, 130], [84, 131], [3, 4] ];
//echo "[" . convertFrac($lst) . "]\n"; // "(20174,34060)(21840,34060)(25545,34060)"
$lst = [ [3, 6] ];
echo "[" . convertFrac($lst) . "]\n"; // "(1,2)"
$lst = [ [69, 138], [80, 1310], [30, 40] ];
echo "[" . convertFrac($lst) . "]\n"; // (262,524)(32,524)(393,524)
$lst = [ [4, 5], [6, 9], [5, 6], [2, 3], [4, 5] ];
echo "[" . convertFrac($lst) . "]\n"; // (24,30)(20,30)(25,30)(20,30)(24,30)
?>