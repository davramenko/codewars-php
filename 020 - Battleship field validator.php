<?php

function validate_battlefield(array $field): bool {
	$res = true;
	$pattern = array(4 => 1, 3 => 2, 2 => 3, 1 => 4);
	$ships = array();
	foreach ($pattern as $k => $v)
		$ships[$k] = 0;
	//for ($i = 0; $i < count($field); $i++) {
	//	echo "      [" . implode(', ', $field[$i]) . "],\n";
	//}

	$ck_cell = function($i, $j, $mode = 0) use (&$field): bool {
		if ($i < 0 || $i >= count($field) || $j < 0 || $j >= count($field[0]))
			return false;
		if ($mode == 0)
			return ($field[$i][$j] !== 0);
		else
			return ($field[$i][$j] == 1);
	};
	$strike_out_right = function($i, $j0) use (&$field, &$ships) {
		$cnt = 0;
		//$arr = array();
		for ($j = $j0; $j < count($field[$i]); $j++) {
			if ($field[$i][$j] == 1) {
				$field[$i][$j] = 2;
				//$arr[] = "($i,$j)";
				$cnt++;
			} else {
				break;
			}
		}
		$ships[$cnt]++;
		//echo "$cnt(r): " . implode(';', $arr) . "\n";
	};
	$strike_out_down = function($i0, $j) use (&$field, &$ships) {
		$cnt = 0;
		//$arr = array();
		for ($i = $i0; $i < count($field); $i++) {
			if ($field[$i][$j] == 1) {
				$field[$i][$j] = 2;
				//$arr[] = "($i,$j)";
				$cnt++;
			} else {
				break;
			}
		}
		$ships[$cnt]++;
		//echo "$cnt(d): " . implode(';', $arr) . "\n";
	};
	for ($i = 0; $i < count($field); $i++) {
		for ($j = 0; $j < count($field[$i]); $j++ ) {
			if ($field[$i][$j] === 0)
				continue;
			if ($ck_cell($i - 1, $j - 1)) {
				echo "$i,$j\n";
				$res = false;
				break;
			}
			if ($ck_cell($i - 1, $j + 1)) {
				echo "$i,$j\n";
				$res = false;
				break;
			}
			if ($ck_cell($i + 1, $j - 1)) {
				echo "$i,$j\n";
				$res = false;
				break;
			}
			if ($ck_cell($i + 1, $j + 1)) {
				echo "$i,$j\n";
				$res = false;
				break;
			}
			if ($field[$i][$j] === 1) {
				if ($ck_cell($i, $j + 1, 1)) {
					$strike_out_right($i, $j);
				} elseif ($ck_cell($i + 1, $j, 1)) {
					$strike_out_down($i, $j);
				} else {
					//echo "1: $i,$j\n";
					//echo print_r($field, true) . "\n";
					$ships[1]++;
					$field[$i][$j] = 2;
					//exit(0);
				}
			}
		}
		if (!$res) break;
	}
	echo print_r($ships, true) . "\n";
	if ($res)
		$res = (count(array_diff_assoc($pattern, $ships)) == 0);
	//echo $res ? "true\n" : "false\n";
	return $res;
}

echo validate_battlefield([
      [1, 0, 0, 0, 0, 1, 1, 0, 0, 0],
      [1, 0, 1, 0, 0, 0, 0, 0, 1, 0],
      [1, 0, 1, 0, 1, 1, 1, 0, 1, 0],
      [1, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 0, 1, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    ]) ? "true\n" : "false\n";

echo validate_battlefield([
      [0, 0, 0, 0, 0, 1, 1, 0, 0, 0],
      [0, 0, 1, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 1, 0, 1, 1, 1, 0, 1, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 0, 1, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    ]) ? "true\n" : "false\n";

echo validate_battlefield([
      [1, 0, 0, 0, 0, 1, 1, 0, 0, 0],
      [1, 0, 1, 0, 0, 0, 0, 0, 1, 0],
      [1, 0, 1, 0, 1, 1, 1, 0, 1, 0],
      [1, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 0, 1, 1, 1, 1, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
      [0, 0, 0, 1, 0, 0, 0, 0, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
      [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    ]) ? "true\n" : "false\n";

?>