<html>
<head>
<title>MOD-IO</title>
<?PHP
$ch1 = 'unchecked';
$ch2 = 'unchecked';
$ch3 = 'unchecked';
$ch4 = 'unchecked';
$r1='0001';
$r2='0010';
$r3='0100';
$r4='1000';

$cmd='0000';

if (isset($_POST['Submit1'])) {

if (isset($_POST['ch1'])) {
$ch1 = $_POST['ch1'];

if ($ch1 == 'rl1') {
$ch1 = 'checked';
//exec('modio w 0x58 0x10 1');
}
}

if (isset($_POST['ch2'])) {
$ch2 = $_POST['ch2'];

if ($ch2 == 'rl2') {
$ch2 = 'checked';
//exec('modio w 0x58 0x10 2');
}
}

if (isset($_POST['ch3'])) {
$ch3 = $_POST['ch3'];

if ($ch3 == 'rl3') {
$ch3 = 'checked';
//exec('modio w 0x58 0x10 4');
}
}

if (isset($_POST['ch4'])) {
$ch4 = $_POST['ch4'];

if ($ch4 == 'rl4') {
$ch4 = 'checked';
//exec('modio w 0x58 0x10 8');
}
}
if ($ch1 == 'checked') {
$cmd =  $r1;
} 
if ($ch2 == 'checked') {
$cmd= $cmd | $r2;
}
if ($ch3 == 'checked') {
$cmd= $cmd | $r3;
}
if ($ch4 == 'checked') {
$cmd= $cmd |  $r4;
}
if (isset($_POST['modioAddr'])) {
$addr = $_POST['modioAddr'];
}


echo "<P> Port mask: ".$cmd."</p>";
$dec = bindec($cmd);
exec("modio w ".$addr." 0x10 ".$dec);
echo "<p>I2C Address is :".$addr."</p>";
echo "<hr>";
}

?>


</head>

<body>




<FORM NAME ="form1" METHOD ="POST" ACTION ="modio.php" >

Select MOD-IO Address
<select name="modioAddr">
  <option value="0x54">0x54</option>
  <option value="0x55">0x55</option>
  <option value="0x58" selected="selected">0x58</option>
</select>
</p>


<Input type = 'Checkbox' Name ='ch1' value ="rl1" 
<?PHP print $ch1; ?>   >Relay 1
<P>
<Input type = 'Checkbox' Name ='ch2' value="rl2" 
<?PHP print $ch2; ?>
>Relay 2
<P>
<Input type = 'Checkbox' Name ='ch3' value="rl3" 
 <?PHP print $ch3; ?> 
>Relay 3
<P>
<Input type = 'Checkbox' Name ='ch4' value="rl4" 
 <?PHP print $ch4; ?> 
>Relay4
<P>


<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Exec">
</FORM>
<hr>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
 $(document).ready(function() {
	  	 $("#digital").load("digital.php");
		    var refreshId = setInterval(function() {
			          $("#digital").load('digital.php?randval='+ Math.random());
				     }, 9000);
   $.ajaxSetup({ cache: false });
});

</script>
</head>
<body>

<div id="digital" name="digital" title="Digital Ports Status">

</div>
<hr>

<script>
 $(document).ready(function() {
	  	 $("#an").load("analog.php");
		    var refreshId = setInterval(function() {
			          $("#an").load('analog.php?randval='+ Math.random());
				     }, 1000);
   $.ajaxSetup({ cache: false });
});

</script>

<div id="an" name="an" title="Analog Ports Status">

</div>



</body>

</html>
