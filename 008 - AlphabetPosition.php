<?php

function alphabet_position(string $s): string {
	$arr = array();
	for ($i = 0; $i < strlen($s); $i++) {
		if (ctype_alpha($s[$i]))
			$arr[] = ord(strtolower($s[$i])) - ord('a') + 1;
	}
	return implode(' ', $arr);
}

echo alphabet_position('The sunset sets at twelve o\' clock.') . "\n";
echo alphabet_position('The narwhal bacons at midnight.') . "\n";

?>