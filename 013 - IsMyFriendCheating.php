<?php

//print implode(',', range(1, 10)) . "\n";

function removeNb($n) {
	$res = array();
	for ($a = 1; $a <= $n; $a++) {
		for ($b = 1; $b <= $n; $b++) {
			if ($a === $b)
				continue;
			$p = $a * $b;
			$s = 0;
			for ($i = 1; $i <= $n; $i++) {
				if ($i === $a || $i === $b)
					continue;
				$s += $i;
			}
			if ($s === $p)
				$res[] = array($a, $b);
		}
	}
	return $res;
}

echo print_r(removeNb(26), true) . "\n";
echo print_r(removeNb(100), true) . "\n";
echo print_r(removeNb(101), true) . "\n";
echo print_r(removeNb(102), true) . "\n";

?>