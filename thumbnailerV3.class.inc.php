<?php
//Class Thumbnailer




class ThumbNailer 
{
	
	//Functions that creates a new image
	//The new image is renamed with the "st", designating it as a thumbnail.
	//The new image is significantly downscaled from the original image. 
	//The function outputs the new image in the designated directory assigned to the $newPath string
	//Returns false if the original image is not supported
	//Returns true on creation of image
	function thumbnail($fileName, $filepath, $filetype) {
		$newPath = $_SERVER['DOCUMENT_ROOT'] . "/thumbnails/";
		$thumbnailName = 'st'.$fileName;
		$newFile = $newPath . $thumbnailName;
		list($width, $height) = resizer($filepath);
		switch($filetype){
			case 'image/jpeg':
				$image = imagecreatefromjpeg($filepath); 
				$image = imagescale($image, $width, $height);
				imagejpeg($image, $newFile, 75);
				break;
			case 'image/png':
				$image = imagecreatefrompng($filepath); 
				$image = imagescale($image, $width, $height);
				imagejpeg($image, $newFile, 75);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($filepath); 
				$image = imagescale($image, $width, $height);
				imagegif($image, $newFile, 75);
				break;
			default:
				return false;
				break;
		}
		return true;
	
	}
	
	//function that contains an algorithm that calculates the size of a new thumbnail.
	//Calculation is determined by the defined stdImgWidth for thumbnails.
	function resizer($filepath)
	{
		$stdImgWidth = 200;
		$stdImgHeight = 200;
		list($width, $height) = getimagesize($filepath);
		$aspectRatio = $width/$height;
		if($width >= $height)
		{
		
			$height = ($height/$width) * $stdImgWidth;
			return array ($stdImgWidth, $height);
		}
		else
		{
			$width = ($width/$height) * $stdImgHeight;
			return array ($width, $stdImgHeight);
		}
	}	
	
	
	//Function that automatically prints HTML to print the thumbnail of a given image
	function thumbnailPrint($fileName)
	{
		$thumbnailName = "st".$fileName;
		$defaultThumb = "defaultNoImg.png";
		$thumbSource = $_SERVER['DOCUMENT_ROOT'].'/thumbnails/'.$thumbnailName;
		$fileSource = '//www.mlchan.net/upload/'.$fileName;
		if(file_exists($thumbSource))
		{
			$print = '<a href="'.$fileSource.'"><img src="//www.mlchan.net/thumbnails/'.$thumbnailName.'" alt="Fiddlestick"></a>';
			return $print;
		}
		else
		{
			$print = '<a href="'.$fileSource.'"><img src="//www.mlchan.net/thumbnails/'.$defaultThumb.'" alt="Fiddlestick"></a>';
			return $print;
		}
	}
}
?>