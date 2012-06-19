<?php

include 'config.php';
//without a bit we can do nothing
if(isset($_POST["bit"])) {
	
	$bit = intval($_POST["bit"]);
	
	//only some bits are allowed.
	//basically you can't access GPIOs you haven't exported before but
	//why should you provoke errors (when accessing non-existant files)?
	if(!in_array($bit, $bits)) {
		exit();
	}
	
	//set direction only when the setdir-parameter is used
	if(isset($_POST["setdir"])) {
		$dir = strtolower(substr($_POST["setdir"], 0, 1));
		if($dir == "i") {
			$dir = "in";
		} elseif($dir == "o") {
			$dir = "out";
		} else {
			$dir = null;
		}
		
		if($dir !== null) {
			echo "echo \"$dir\" > /sys/class/gpio/gpio$bit/direction";
			echo shell_exec("echo \"$dir\" > /sys/class/gpio/gpio$bit/direction");
		}
	}
	
	//set value only when the setval-parameter is used
	if(isset($_POST["setval"])) {
		$val = intval($_POST["setval"]);
		shell_exec("echo \"$val\" > /sys/class/gpio/gpio$bit/value");
	}
}
