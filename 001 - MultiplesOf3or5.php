<?php

function solution($number){
  $arr = array();
  for ($i = 3; $i < $number; $i += 3)
    $arr[$i] = '';
  for ($i = 5; $i < $number; $i += 5)
    $arr[$i] = '';
  echo print_r($arr, true) . "\n";
  $res = 0;
  foreach ($arr as $k => $v)
    $res += $k;
  return $res;
}

echo solution(16) . "\n";

?>