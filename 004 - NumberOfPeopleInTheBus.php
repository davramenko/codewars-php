<?php

function number($bus_stops) {
	$res = 0;
	foreach ($bus_stops as $stop)
		$res += $stop[0] - $stop[1];
	return $res;
}

echo number(array(array(1, 0), array(2, 1))) . "\n";


?>