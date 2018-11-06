<?php

function high($x) {
	$words = explode(' ', $x);
	$scores = array_combine($words, array_map(function($word) {
		$wscore = 0;
		for ($i = 0; $i < strlen($word); $i++) {
			if (!ctype_alpha($word[$i]))
				continue;
			$wscore += ord(strtolower($word[$i])) - ord('a') + 1;
		}
		return $wscore;
	}, $words));
	//echo print_r($scores, true) . "\n";
	return array_reduce(array_keys($scores), function($carry, $key)  use ($scores) {
		if ($carry === null) {
			return $key;
		} else if ($scores[$key] > $scores[$carry]) {
			return $key;
		} else {
			return $carry;
		}
	}, null);
}

echo high('man i need a taxi up to ubud') . "\n";
echo high('what time are we climbing up the volcano') . "\n";
echo high('take me to semynak') . "\n";

?>