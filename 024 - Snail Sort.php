<?php

// Snail Sort

function snail(array $array): array {
	$res = [];
	if (count($array[0]) == 0)
		return $res;
	$n = count($array[0]);
	$offset = 0;
	while (true) {
		$i = $offset;
		$j = $offset;
		for ($dir = 0; $dir < 4; ) {
			//echo "dir=$dir; i=$i; j=$j; offset=$offset\n";
			$res[] = $array[$i][$j];
			if (count($res) >= ($n * $n))
				break;
			$fexit = false;
			switch ($dir) {
				case 0:
					$j++;
					if ($j >= ($n - $offset)) {
						$j = ($n - $offset - 1);
						$i++;
						$dir++;
					}
					break;
				case 1:
					$i++;
					if ($i >= ($n - $offset)) {
						$i = ($n - $offset - 1);
						$j--;
						$dir++;
					}
					break;
				case 2:
					$j--;
					if ($j < $offset) {
						$j = $offset;
						$i--;
						$dir++;
					}
					break;
				case 3:
					$i--;
					if ($i < ($offset + 1)) {
						$dir++;
					}
					break;
			}
		}
		$offset++;
		if (count($res) >= ($n * $n))
			break;
	}
	return $res;
}

echo join(',', snail([
      [1, 2, 3],
      [4, 5, 6],
      [7, 8, 9]
    ])) . "\n";
echo join(',', snail([
      [1, 2, 3],
      [8, 9, 4],
      [7, 6, 5]
    ])) . "\n";
echo join(',', snail([
      [1, 2, 3, 1],
      [4, 5, 6, 4],
      [7, 8, 9, 7],
      [7, 8, 9, 7]
    ])) . "\n";
echo join(',', snail([
      [1, 2, 3, 4, 5],
      [6, 7, 8, 9, 0],
      [1, 2, 3, 4, 5],
      [6, 7, 8, 9, 0],
      [1, 2, 3, 4, 5]
    ])) . "\n";
echo join(',', snail([
      [1, 2, 3, 4, 5, 6],
      [7, 8, 9, 0, 1, 2],
      [3, 4, 5, 6, 7, 8],
      [9, 0, 1, 2, 3, 4],
      [5, 6, 7, 8, 9, 0],
      [1, 2, 3, 4, 5, 6]
    ])) . "\n";

?>