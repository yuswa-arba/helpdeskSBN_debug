<?php

function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//Construct a proportional size of new image
	$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 
	$NewWidth  			= ceil($ImageScale*$CurWidth);
	$NewHeight 			= ceil($ImageScale*$CurHeight);
	$NewCanves 			= imagecreatetruecolor($NewWidth, $NewHeight);
	
	imagealphablending($NewCanves, false);
        imagesavealpha($NewCanves,true);
        $transparent = imagecolorallocatealpha($NewCanves, 255, 255, 255, 127);
        imagefilledrectangle($NewCanves, 0, 0, $NewWidth, $NewHeight, $transparent);
        
	
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	//Destroy image, frees memory	
	if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
	return true;
	}

}

//This function corps image to create exact square images, no matter what its original size!
function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType){
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//abeautifulsite.net has excellent article about "Cropping an Image to Make Square"
	//http://www.abeautifulsite.net/blog/2009/08/cropping-an-image-to-make-square-thumbnails-in-php/
	if($CurWidth>$CurHeight)
	{
		$y_offset = 0;
		//$x_offset = ($CurWidth - $CurHeight) / 2;
		$x_offset = 0;
		//$square_size 	= $CurWidth - ($x_offset * 2);
		$square_size 	= 200;
	}else{
		$x_offset = 0;
		//$y_offset = ($CurHeight - $CurWidth) / 2;
		$y_offset = 0;
		//$square_size = $CurHeight - ($y_offset * 2);
		$square_size = 200;
	}
	
	$NewCanves 	= imagecreatetruecolor($iSize, $iSize);	
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	//Destroy image, frees memory	
	if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
	return true;

	}

}


function cekType($fileFoto,$typeGambar) {
    $typeFile = strtolower($fileFoto[type]);
  if(in_array($typeFile,$typeGambar)) {
    return true;
  } else {
    return false;
  }
}
function cekUkuran($fileFoto,$ukuranMin,$ukuranMax) {
  if($fileFoto[size] > $ukuranMin AND $fileFoto[size] < $ukuranMax) {
     return true;
  } else {
     return false;
  }
}

function prosesUpload($fileFoto,$pathFileTujuan) {
    if (@move_uploaded_file($fileFoto['tmp_name'], $pathFileTujuan)) {
    return true;
	//header ("location: network");
    }  else {
	return false;
    //header ("location: form_klien_isp");
    }
}

?>