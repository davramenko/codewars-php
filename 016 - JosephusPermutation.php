<?php

function josephus(array $items, int $k): array {
	$res = array();
	$i = -1;
	//while (count($items) >= 1) {
	while (array_sum($items) != (count($items) * -1)) {
		//if (count($items) == 1) {
		//	$res[] = $items[0];
		//	break;
		//}
		//if ($i >= 0)
		//	echo ", ";
		for ($j = 0; $j < $k; ) {
			$i++;
			if ($i >= count($items))
				$i = 0;
			if ($items[$i] < 0)
				continue;
			$j++;
		}
		//$i += $k;
		//while ($i >= count($items))
		//	$i -= count($items);
		//echo "$i: {$items[$i]}";
		$res[] = $items[$i];
		$items[$i] = -1;
		//array_splice($items, $i, 1);
		//echo "(" . count($items) . ")";
		//echo "(" . print_r($items, true) . ")";
	}
	//echo "\n";
	return $res;
}

echo print_r(josephus([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 1), true) . "\n";
//echo print_r(josephus([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 2), true) . "\n";
echo print_r(josephus(["C", "o", "d", "e", "W", "a", "r", "s"], 4), true) . "\n";
echo print_r(josephus([1, 2, 3, 4, 5, 6, 7], 3), true) . "\n";
echo print_r(josephus([], 3), true) . "\n";

?>