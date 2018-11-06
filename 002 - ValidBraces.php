<?php

function validBraces($braces){
	$stack = array();
	for ($i = 0; $i < strlen($braces); $i++) {
		$ch = $braces[$i];
		if ((count($stack) > 0) && (strpos(")]}", $ch) !== false)) {
			$pos = strpos("([{", array_pop($stack));
			$rqbr = ")]}"[$pos];
			if (strcmp($rqbr, $ch) !== 0)
				return false;
		} else if (strpos("([{", $ch) !== false) {
			array_push($stack, $ch);
		} else {
			return false;
		}
	}
	return count($stack) === 0;
}

foreach (array("()", "[(])", "{([]{()})}", "{([]{()})}(", "{([]{()})") as $sample) {
	echo "$sample: " . (validBraces($sample) ? "true" : "false"). "\n";
}
?>