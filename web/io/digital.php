<?PHP 
$in1 = '';
$in2 = '';
$in3 = '';
$in4 = '';

$res = exec('modio r 0x58 0x20');
//echo $res;
list($reg,$value) = split(':',$res); 
$value = $value  ;
$bin = base_convert($value,10,2) | 0;
$bitarr = str_split($bin);
//echo count($bitarr);
while (count($bitarr) < 4 ) {

array_push($bitarr,'0');

}

if ($bitarr[3] == '1') {
	$in1='High';
} else {

	$in1='Low';
}


if ($bitarr[2] == '1') {
	$in2='High';
} else {

	$in2='Low';
}

if ($bitarr[1] == '1') {
	$in3='High';
} else {

	$in3='Low';
}


if ($bitarr[0] == '1') {
	$in4='High';
} else {

	$in4='Low';
}

?>
<html>
<head>
</head>
<body>
Digital IN Ports State :
<P> Digital IN 1:<?PHP echo $in1; ?> 
<P> Digital IN 2:<?PHP echo $in2; ?> 
<P> Digital IN 3:<?PHP echo $in3; ?> 
<P> Digital IN 4:<?PHP echo $in4; ?> 

</body>
</html>
