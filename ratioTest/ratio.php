<?php
echo '<!doctype html>';
echo '<head><title>Ratio Test</title><style>
table, th, td {
    border: 1px solid black;
}
</style></head>';
$link = new mysqli("localhost", "root", "", "tester");
if ($link->connect_errno) {
    echo "Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
}
	
$rangeStart = mysqli_real_escape_string($link, $_GET['StartRange']);
$rangeEnd = mysqli_real_escape_string($link, $_GET['EndRange']);
$compWidth = mysqli_real_escape_string($link, $_GET['compareWidth']);
$compHeight = mysqli_real_escape_string($link, $_GET['compareHeight']);

$ySide = $_GET['ySide'];
$desiredSide = $_GET['yValue'];
//$height = ($width/$height) * $stdImgWidth;

$compRatio = $compWidth/$compHeight;

print 'Compare Ratio: '.$compRatio;

print '<h1>Printing all width/height pairs between '.$rangeStart.' and '.$rangeEnd.':</h1>';
print '<table>';
if($ySide == "Width"){
	print '<tr><th>Width</th><th>NewHeight</th><th>Value of Width/Height</th></tr>';
	for($x = $rangeStart; $x <= $rangeEnd; $x++) {
		print '<tr>';
		$height = ($compWidth/$compHeight) * $x;
		print '<td>'.$x.'</td>';
		if((floor($height) == $height) && (!is_infinite($height))){
			print '<td style="background-color:green">'.$height."</td>";
		} else {
			print '<td>'.$height."</td>";
		}
		print '<td style="background-color:Orange">'.($x/$height).'</td></tr>';
	//	if(is_float($height)){
//		print 'Value of '.$x.'/'.$height.': '.($x/$height).'<br>';
	//	} else {
	//		print 'Value of '.$x.'/'.$height.': '.($x/$height).'<br>';
	//	}
		
		
	}
} else if($ySide == "Height") {
	for($x = $rangeStart; $x <= $rangeEnd; $x++) {
	
	}
} 
?>