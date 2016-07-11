<?php
echo '<!doctype html>';
echo '<head><title>Actual Image Test</title><style>
table, th, td {
    border: 1px solid black;
}
</style></head>';
$link = new mysqli("localhost", "root", "", "tester");
if ($link->connect_errno) {
    echo "Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
}
	
$rangeStart = mysqli_real_escape_string($link, $_POST['StartRange']);
$rangeEnd = mysqli_real_escape_string($link, $_POST['EndRange']);
//$compWidth = mysqli_real_escape_string($link, $_GET['compareWidth']);
//$compHeight = mysqli_real_escape_string($link, $_GET['compareHeight']);
list($compWidth, $compHeight, $imageType) = getimagesize($_FILES['image']['tmp_name']);



$ySide = $_POST['ySide'];
$desiredSide = $_POST['yValue'];
//$height = ($width/$height) * $stdImgWidth;

$compRatio = $compWidth/$compHeight;
print 'compWidth: '.$compWidth.'<br>';
print 'compHeight: '.$compHeight.'<br>';
print 'Compare Ratio: '.$compRatio;

print '<h1>Printing all width/height pairs between '.$rangeStart.' and '.$rangeEnd.':</h1>';
print '<table>';
print '<tr><th>Width</th><th>NewHeight</th><th>Value of Width/Height</th></tr>';
if($ySide == "Width"){
	
	for($d = $rangeStart; $d <= $rangeEnd; $d++) {
		print '<tr>';
		$height = ($d*$compHeight) / $compWidth;
		print '<td>'.$d.'</td>';
		if((floor($height) == $height) && (!is_infinite($height))){
			print '<td style="background-color:green">'.$height."</td>";
		} else  {
			print '<td>'.$height."</td>";
		}
		print'<td style="background-color:Orange">'.($d/$height).'</td></tr>';
	}
	
	print'</table>';
	
} 
else if($ySide == "Height") {
	print '<tr><th>Height</th><th>NewWidth</th><th>Value of Width/Height</th></tr>';
	for($d = $rangeStart; $d <= $rangeEnd; $d++) {
		print '<tr>';
		$Width = ($d*$compWidth) / $compHeight;
		print '<td>'.$d.'</td>';
		if((floor($Width) == $Width) && (!is_infinite($Width))){
			print '<td style="background-color:green">'.$Width."</td>";
		} else {
			print '<td>'.$Width."</td>";
		}
		print '<td style="background-color:Orange">'.($Width/$d).'</td></tr>';
	//	if(is_float($height)){
//		print 'Value of '.$x.'/'.$height.': '.($x/$height).'<br>';
	//	} else {
	//		print 'Value of '.$x.'/'.$height.': '.($x/$height).'<br>';
	//	}
		
		
	}
} 
?>