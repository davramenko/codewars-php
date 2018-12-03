<?php

function dblLinear($n) {
	$u = [1];
	$x = 0;
	$y = 0;
	for ($i = 0; $i < $n; $i++) {
		$nextX = 2 * $u[$x] + 1;
		$nextY = 3 * $u[$y] + 1;
		if ($nextX <= $nextY) {
			array_push($u, $nextX);
			$x++;
			if ($nextX == $nextY)
				$y++;
		} else {
			array_push($u, $nextY);
			$y++;
		}
	}
	return $u[$n];
}

echo dblLinear(10) . "\n";
echo dblLinear(20) . "\n";
echo dblLinear(30) . "\n";
echo dblLinear(50) . "\n";
echo dblLinear(100) . "\n";

?>