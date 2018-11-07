<?php

//print implode(',', range(1, 10)) . "\n";

function removeNb($n) {
	$sum = $n * ($n + 1) / 2;
	$res = array();
	for ($b = $n; $b > 0; $b--) {
		$a = ($sum - $b) / ($b + 1);
		if ($a < $n && intval($a) == $a)
			$res[] = array($a, $b);
	}
	return $res;
}

echo print_r(removeNb(26), true) . "\n";
echo print_r(removeNb(100), true) . "\n";
echo print_r(removeNb(101), true) . "\n";
echo print_r(removeNb(102), true) . "\n";
echo print_r(removeNb(30200), true) . "\n";

?>