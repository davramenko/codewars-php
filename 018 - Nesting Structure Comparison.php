<?php

function same_structure_as(array $a, array $b): bool {
	$getArrayStruct = function(array $arr) use (&$getArrayStruct) : string {
		$str = "[";
		for ($i = 0; $i < count($arr); $i++) {
			$node = $arr[$i];
			if ($i > 0)
				$str .= ",";
			if (gettype($node) == 'array')
				$str .= $getArrayStruct($node);
			else
				$str .= "n";
		}
		return $str . "]";
	};
	return (strcmp($getArrayStruct($a), $getArrayStruct($b)) === 0);
}

echo (same_structure_as([1, 1, 1], [2, 2, 2]) ? "true" : "false") . "\n";
echo (same_structure_as([1, [1, 1]], [2, [2, 2]]) ? "true" : "false") . "\n";
echo (same_structure_as([1, [1, 1]], [[2, 2], 2]) ? "true" : "false") . "\n";
echo (same_structure_as([1, [1, 1]], [[2], 2]) ? "true" : "false") . "\n";
echo (same_structure_as([[[], []]], [[[], []]]) ? "true" : "false") . "\n";
echo (same_structure_as([[[], []]], [[1, 1]]) ? "true" : "false") . "\n";

?>