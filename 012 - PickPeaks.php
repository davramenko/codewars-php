<?php

function pickPeaks($arr) {
	$raise = false;
	$idx = -1;
	$pos = array();
	$peaks = array();
	for ($i = 1; $i < count($arr); $i++) {
		if ($arr[$i - 1] < $arr[$i]) {
			$raise = true;
			$idx = $i;
			continue;
		}
		if ($raise && $arr[$idx] > $arr[$i]) {
			$raise = false;
			$pos[] = $idx;
			$peaks[] = $arr[$idx];
		}
	}
	return array('pos' => $pos, 'peaks' => $peaks);
}


//echo print_r(pickPeaks([3, 2, 3, 6, 4, 1, 2, 3, 2, 1, 2, 3]), true) . "\n";
//echo print_r(pickPeaks([1, 2, 2, 2, 1]), true) . "\n";
//echo print_r(pickPeaks([3, 2, 2, 2, 1, 2, 2]), true) . "\n";
echo print_r(pickPeaks([1,2,5,4,3,2,3,6,4,1,2,3,3,4,5,3,2,1,2,3,5,5,4,3]), true) . "\n";

?>