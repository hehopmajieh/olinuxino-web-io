<?PHP

function execOutput($command) {
	    $output = array($command);
	        exec($command.' 2>&1', $output);
		$test= implode("\n", $output);
		preg_replace('/i2c/', '', $test);
		return $test;	
	}

echo execOutput('i2cdetect -y -r 0');

?>
