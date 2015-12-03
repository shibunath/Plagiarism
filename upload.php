<html>
<head>
	<title>
		Plagiarism Results
	</title>
	<font color=white><center><h1><b>Plagiarism Results</b></h1></center>
	<link rel="stylesheet" type="text/css" href="plagiarism.css">
	</head>

<script>
function match()
{
	var matchs=<?php echo json_encode($matched) ?>;
	document.getElementById("contents").innerHTML="shibu";
}
</script>
<body bgcolor=black>
		
<?php

function getWords($a)
{
	return preg_split('/\W+/', $a, -1, PREG_SPLIT_NO_EMPTY);
}

function hashs($a)
{
	$sum=0;
	$b=str_split($a);
	foreach ($b as $key) {
		$sum+=ord($key);
	}
	return ($sum%50);

}

if(isset($_FILES['cfile']) && isset($_FILES['rfile']))
{
$rfile=$_FILES['rfile']['name'];
$cfile=$_FILES['cfile']['name'];
$matched=array();
$words=getWords(fread(fopen($rfile,'r'),filesize($rfile)));
$words1=getWords(fread(fopen($cfile,'r'),filesize($cfile)));
$x=0;
$per=0;
foreach($words as $val)
{
foreach($words1 as $val1)
{
	if(hashs($val)===hashs($val1))
	{
		if($val===$val1)
		{
		$x++;
array_push($matched,$val1);
	}
	}
}
}
if($x>0)
{
	$per=($x/count($words1))*100;
}
print_r("<center><font color=red size=6>".$per."%"." Plagiarism"."</font></center><br>");
foreach($matched as $d)
{
//	print_r($d."<br>");
}
$contents=file_get_contents($cfile);
$contents=explode(' ',$contents);
?>
<style>
.plagiarism
{
	background-color: lightblue;
	margin:auto;
	width: 500px;
	margin-top:1px;
	font-weight: bolder;
	height: 140px;
	border: 5px solid green;
	color: black;
}
</style>
<div class="plagiarism">
<?php

foreach($contents as $O)
{
	$p=0;
	/*foreach ($matched as $I) {
		if($O===$I)
		{
echo "<font color=red>".$O."</font>  ";
		}
		else
		{
echo $O." ";
		}
		
	}*/
	foreach($matched as $I)
	{
		if($O===$I)
			$p=1;
	}
	if($p===1)
	echo "<font color=red>".$O." </font> ";
else
	echo $O." ";
$p=0; 
}

}

?>
</div>
</body>
</font>
</html>
