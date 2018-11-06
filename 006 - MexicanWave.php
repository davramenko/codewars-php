<?php

function wave($people) {
	$arr = [];
	$j = 0;
	for ($i = 0; $i < strlen($people); $i++) {
		if (ctype_space($people[$i]))
			continue;
		$arr[$j] = $people;
		$arr[$j][$i] = strtoupper($people[$i]);
		$j++;
	}
	return $arr;
}

echo print_r(wave("hello"), true) . "\n";
echo print_r(wave("codewars"), true) . "\n";
echo print_r(wave(""), true) . "\n";
echo print_r(wave("two words"), true) . "\n";
echo print_r(wave(" gap "), true) . "\n";

?>