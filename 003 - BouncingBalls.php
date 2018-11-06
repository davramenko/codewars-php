<?php

function bouncingBall($h, $bounce, $window) {
	if ($h <= 0 || $bounce <= 0 || $bounce >= 1 || $window >= $h)
		return -1;
	$res = 1;
	for ($b = $bounce * $h; $b > $window; $b *= $bounce)
		$res += 2;
	return $res;
}

echo bouncingBall(3.0, 0.66, 1.5) . "\n";
echo bouncingBall(30.0, 0.66, 1.5) . "\n";
echo bouncingBall(10, 0.6, 10) . "\n";

?>