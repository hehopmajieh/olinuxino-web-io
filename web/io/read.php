<?php
include 'config.php'

$retval = array();

for($x = 0; $x < count($bits); $x++) {
	$bit = $bits[$x];
	$val = trim(@shell_exec("cat /sys/class/gpio/gpio".$bit."/value"));
	$dir = trim(@shell_exec("cat /sys/class/gpio/gpio".$bit."/direction"));
	
	$val = $val == "1" ? 1 : 0;
	$dir = $dir == "out" ? "o" : "i";
	
	$retval[] = array("bit" => $bit, "val" => $val, "dir" => $dir);
}

echo json_encode($retval);
