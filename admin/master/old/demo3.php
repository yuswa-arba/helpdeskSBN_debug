<?php require_once "../../config/phpuploader/include_phpuploader.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Demo 2 - use UploadUrl property</title>
</head>
<body>
<div>
	<?php
		$uploader=new PhpUploader();

		$uploader->MultipleFilesUpload=true;
		$uploader->InsertText="Select multiple files (Max 10M)";
		
		$uploader->MaxSizeKB=10240;
		$uploader->AllowedFileExtensions="*.jpg,*.png,*.gif,*.bmp";
		
		$uploader->UploadUrl="demo3_upload.php";
		
		$uploader->Render();
	?>
	
	
	</div>
</body>
	
</html>