<?php
  
function countBits($n)  {
	return (substr_count(base_convert($n, 10, 2), '1'));
}

echo countBits(0) . "\n";
echo countBits(4) . "\n";
echo countBits(7) . "\n";
echo countBits(9) . "\n";
echo countBits(10) . "\n";

?>