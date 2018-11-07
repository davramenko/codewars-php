<?php

function permutations(string $s): array {
	$permute = function($str) use (&$permute) {
		if (strlen($str) <= 1)
			return array($str);
		$res = array();
		for ($i = 0; $i < strlen($str); $i++) {
			$achar = $str[$i];
			$rest = (($i > 0) ? substr($str, 0, $i) : "") . ($i < (strlen($str) - 1) ? substr($str, $i + 1) : "");
			array_push($res, ...array_map(function($val) use ($achar, &$res) {
				return $achar . $val;
			}, $permute($rest)));
		}
		//echo "RES: " . print_r($res, true) . "\n";
		return array_unique($res);
	};
	return $permute($s);
}

echo print_r(permutations('a'), true) . "\n";
echo print_r(permutations('ab'), true) . "\n";
echo print_r(permutations('aabb'), true) . "\n";
//echo print_r(permutations('1234'), true) . "\n";

?>