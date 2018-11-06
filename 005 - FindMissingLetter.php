<?php

function find_missing_letter(array $array): string {
	$c = ord($array[0][0]);
	for ($i = 0; $i < count($array); $i++) {
		if (strcmp(chr($c), $array[$i]) !== 0)
			return chr($c);
		$c++;
	}
	return "";
}

echo find_missing_letter(['a','b','c','d','f']) . "\n";
echo find_missing_letter(["O", "Q", "R", "S"]) . "\n";

?>