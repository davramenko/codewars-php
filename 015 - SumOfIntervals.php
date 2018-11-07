<?php

// Sum of Intervals

function sum_intervals(array $intervals): int {
	$pool = array();
	$addInterval = function(array $interval) use (&$pool) {
		//echo "addInterval: {$interval[0]} - {$interval[1]}\n";
		$ckOverlapping = function(array $int1, array $int2, bool $ftouch): int {
			//echo "{$int1[0]} - {$int1[1]} <=> {$int2[0]} - {$int2[1]}\n";
			$nm = 0;
			if ($ftouch) $nm = 1;
			if ($int1[0] >= $int2[0] && $int1[1] <= $int2[1]) {
				return 2; // Fully covers
			} else if ($int1[0] < $int2[0] && ($int2[0] - $nm) <= $int1[1] && $int2[1] > $int1[1]) {
				return 1; // Appends
			} else if ($int2[1] < $int1[1] && $int2[1] >= ($int1[0] - $nm) && $int2[0] < $int1[0]) {
				return -1; // Prepends
			} else if ($int1[0] <= $int2[0] && $int1[1] >= $int2[1]) {
				return -2; // Flow into
			}
			return 0;
		};
		$overlappings = array();
		$app_idx = $prep_idx = -1;
		$new = (count($pool) == 0);
		$extra = false;
		for ($i = 0; $i < count($pool); $i++) {
			switch ($ckOverlapping($pool[$i], $interval, false)) {
				case -2: // Flow into
					$extra = true;
					//echo "Flow into\n";
					break;
				case -1: // Prepends
					//echo "Prepends\n";
					$prep_idx = $i;
					break;
				case 1: // Appends
					//echo "Appends\n";
					$app_idx = $i;
					break;
				case 2: // Fully covers
					//echo "Fully covers\n";
					$overlappings[] = $i;
					$new = true;
					break;
				default: // 0 - Touch nothing
					//echo "New\n";
					$new = true;
					break;
			}
		}
		//if (count($overlappings) > 0)
		//	$new = false;
		if ($extra) $new = false;
		if ($app_idx >= 0 && $prep_idx >= 0) {
			$pool[$app_idx] = array($pool[$app_idx][0], $pool[$prep_idx][1]);
			$overlappings[] = $prep_idx;
			$new = false;
		} else if ($app_idx < 0 && $prep_idx >= 0) {
			$pool[$prep_idx] = array($interval[0], $pool[$prep_idx][1]);
			$new = false;
		} else if ($app_idx >= 0 && $prep_idx < 0) {
			$pool[$app_idx] = array($pool[$app_idx][0], $interval[1]);
			$new = false;
		}
		// sort overlappings
		rsort($overlappings, SORT_NUMERIC);
		foreach ($overlappings as $o) {
			array_splice($pool, $o, 1);
		}
		if ($new) $pool[] = $interval;
		// sort pool
		if (count($pool) > 1) {
			usort($pool, function($a, $b) {
				//echo "usort: a={$a[0]}; b={$b[0]}\n";
				return $a[0] - $b[0];
			});
		}
		//echo print_r($pool, true) . "\n";
	};
	foreach ($intervals as $interval)
		$addInterval($interval);
	//echo print_r($pool) . "\n";
	$sum = 0;
	//foreach ($pool as $interval)
	//	$sum += $interval[1] * ($interval[1] + 1) / 2 - ($interval[0] - 1) * $interval[0] / 2;
	foreach ($pool as $interval)
		$sum += $interval[1] - $interval[0]; 
	return $sum;
}

echo sum_intervals([[1, 5]]) . "\n";
echo sum_intervals([[1, 5], [6, 10]]) . "\n";
echo sum_intervals([[1, 5], [1, 5]]) . "\n";
echo sum_intervals([[1, 4], [7, 10], [3, 5]]) . "\n";
echo sum_intervals([[1, 5], [10, 20], [1, 6], [16, 19], [5, 11]]) . "\n";

echo sum_intervals([[1, 4], [5, 6], [7, 11], [3, 15]]) . "\n";

?>