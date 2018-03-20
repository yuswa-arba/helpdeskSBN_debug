<?php 
include ("../../config/configuration.php");
require_once "../../config/phpuploader/include_phpuploader.php";

$uploader=new PhpUploader();

$mvcfile=$uploader->GetValidatingFile();

//USER CODE:

$targetfilepath= "../../img/dataupload/customer/gnb_" .mt_rand(). str_replace(" ", "", $mvcfile->FileName);
if( is_file ($targetfilepath) )
	$targetfilepath .= $targetfilepath. "_" . mt_rand();
$mvcfile->CopyTo( $targetfilepath );

//$uploader->WriteValidationOK("");

?>