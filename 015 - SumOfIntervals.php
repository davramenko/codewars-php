<?php

// Sum of Intervals

function sum_intervals(array $intervals): int {
	$pool = array();
	$addInterval = function(array $interval) use (&$pool) {
		$ckOverlapping = function(array $int1, array $int2): int {
			//echo "{$int1[0]} - {$int1[1]} <=> {$int2[0]} - {$int2[1]}\n";
			if ($int1[0] >= $int2[0] && $int1[1] <= $int2[1]) {
				return 2; // Fully covers
			} else if ($int1[0] < $int2[0] && $int2[0] <= $int1[1] && $int2[1] > $int1[1]) {
				return 1; // Appends
			} else if ($int2[1] < $int1[1] && $int2[1] >= $int1[0] && $int2[0] < $int1[0]) {
				return -1; // Prepends
			} else if ($int1[0] <= $int2[0] && $int1[1] >= $int2[1]) {
				return -2; // Flow into
			}
			return 0;
		};
		$overlappings = array();
		for ($i = 0; $i < count($pool); $i++) {
		}
		foreach ($overlappings as $o) {
			// Apply overlappings
		}
		if (count($overlappings) == 0) {
		} else {
			
		}
	};
	foreach ($intervals as $interval)
		$addInterval($interval);
	$sum = 0;
	foreach ($pool as $interval)
		$sum += $interval[1] * ($interval[1] + 1) / 2 - ($interval[0] - 1) * $interval[0] / 2;
	return $sum;
}

echo sum_intervals([[1, 5]]) . "\n";
echo sum_intervals([[1, 5], [6, 10]]) . "\n";
echo sum_intervals([[1, 5], [1, 5]]) . "\n";
echo sum_intervals([[1, 4], [7, 10], [3, 5]]) . "\n";

?>