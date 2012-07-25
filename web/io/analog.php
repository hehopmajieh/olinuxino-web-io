<?PHP 
function floor_dec($number,$precision,$separator)
{
    $numberpart=explode($separator,$number);
    $numberpart[1]=substr_replace($numberpart[1],$separator,$precision,0);
    if($numberpart[0]>=0)
    {$numberpart[1]=floor($numberpart[1]);}
    else
    {$numberpart[1]=ceil($numberpart[1]);}

     $ceil_number= array($numberpart[0],$numberpart[1]);
    return implode($separator,$ceil_number);
}
function convert_adc($value) 
{
	$temp = (3.3 / 1024) * $value;
	return floor_dec($temp,2,"."); 
	
}

$resain1 = exec('i2cget -y 0 0x58 0x30 w');
$resain2 = exec('i2cget -y 0 0x58 0x31 w');
$resain3 = exec('i2cget -y 0 0x58 0x32 w');
$resain4 = exec('i2cget -y 0 0x58 0x33 w');
$resain1 = base_convert($resain1,16,10) ;
$resain2 = base_convert($resain2,16,10) ;
$resain3 = base_convert($resain3,16,10) ;
$resain4 = base_convert($resain4,16,10) ;


?>
<html>
<head>

</head>
<body>
Analog IN Ports State :
<P> Analog  IN 1: <?PHP echo convert_adc($resain1);?> Volts    
<P> Analog  IN 2: <?PHP echo convert_adc($resain2);?> Volts    
<P> Analog  IN 3: <?PHP echo convert_adc($resain3);?> Volts    
<P> Analog  IN 4: <?PHP echo convert_adc($resain4);?> Volts    

</body>
</html>
