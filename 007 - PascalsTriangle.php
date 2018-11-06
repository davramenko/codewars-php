<?php

function pascals_triangle($n) {
	$a = array();
	for ($i = 0; $i < $n; $i++) {
		$a[$i] = array_fill(0, $i + 1, 1);
	}
	for ($i = 2; $i < $n; $i++) {
		for ($j = 1; $j < (count($a[$i]) - 1); $j++) {
			$a[$i][$j] = $a[$i - 1][$j - 1] + $a[$i - 1][$j];
		}
	}
	$amrg = null;
	$amrg = function($arr, $i) use (&$amrg) {
		if ($i >= count($arr))
			return array();
		return array_merge($arr[$i], $amrg($arr, $i + 1));
	};
	return array_merge($a[0], $amrg($a, 1));
}

echo print_r(pascals_triangle(5), true) . "\n";

?>