<?php

function is_solved(array $board): int {
	$line_defs = [
		[[0,0], [0,1], [0,2]],
		[[1,0], [1,1], [1,2]],
		[[2,0], [2,1], [2,2]],
		[[0,0], [1,0], [2,0]],
		[[0,1], [1,1], [2,1]],
		[[0,2], [1,2], [2,2]],
		[[0,0], [1,1], [2,2]],
		[[0,2], [1,1], [2,0]]
	];
	// Results:
	// 0, *		- line is free
	// 1, 1/2	- fully occuped by 1 or 2
	// 2, 1/2	- still may be occuped by 1 or 2
	// 3, *		- fully occuped by both
	// 4, *		- occuped by both but not completely
	// -1, *	- undefined (should not return)
	$ckLine = function(array $line_def) use (&$board): array {
		$stat = 0;
		$who = 0;
		$what = array();
		//echo print_r($line_def, true) . "\n";
		foreach ($line_def as $a) {
			$sym = $board[$a[0]][$a[1]];
			if ($sym != 0) {
				$stat = -1;
				if (array_key_exists($sym, $what))
					$what[$sym]++;
				else
					$what[$sym] = 1;
			}
		}
		if ($stat != 0) {
			$sum = array_sum(array_values($what));
			if (count($what) == 2) {
				$stat = 4;
				if ($sum == 3) {
					$stat = 3;
				}
			} else {
				// what == 1
				$who = array_keys($what)[0];
				$stat = 2;
				if ($sum == 3) {
					$stat = 1;
				}
			}
		}
		echo "ck_line: stat=$stat, who=$who\n";
		return array($stat, $who);
	};
	// -1 if the board is not yet finished (there are empty spots),
	// 1 if "X" won,
	// 2 if "O" won,
	// 0 if it's a cat's game (i.e. a draw).
	$res = 0;
	$cnt = 0;
	foreach ($line_defs as $line_def) {
		list($status, $who) = $ckLine($line_def);
		echo "status=$status, who=$who, res=$res, cnt=$cnt\n";
		switch ($status) {
			case 1:
				$res = $who;
				break;
			case 0:
			case 2:
				$cnt++;
		}
		if ($res != 0)
			break;
	}
	if ($res == 0 && $cnt > 0)
		$res = -1;
	return $res;
}

echo is_solved([
      [2, 0, 1],
      [0, 1, 2],
      [2, 1, 0]

//      [0, 0, 1],
//      [0, 1, 2],
//      [2, 1, 0]
    ]) . "\n";

?>