<?php

function determinant(array $matrix): int {
	//echo print_r($matrix, true) . "\n";
	$minor = function(array $m, int $j): array {
		$arr = array();
		for ($k = 1; $k < count($m[0]); $k++) {
			$row = array();
			for ($l = 0; $l < count($m[0]); $l++) {
				if ($l !== $j)
					$row[] = $m[$k][$l];
			}
			$arr[] = $row;
		}
		return $arr;
	};
	if (count($matrix[0]) == 1) {
		return $matrix[0][0];
	} elseif (count($matrix[0]) == 2) {
		return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
	} else {
		$res = 0;
		for ($i = 0; $i < count($matrix[0]); $i++) {
			$res += pow(-1, $i) * $matrix[0][$i] * determinant($minor($matrix, $i));
		}
		return $res;
	}
}


echo determinant([[1]]) . "\n";
echo determinant([
		[1, 3],
		[2, 5]
	]) . "\n";
echo determinant([
		[2, 5, 3],
		[1, -2, -1],
		[1, 3, 4]
	]) . "\n";

?>