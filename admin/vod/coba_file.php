<?php
$dir = 'tvod/tvsctv/';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        $data_folder = array();
		while (($file = readdir($dh)) !== false) {
				//time modified
				
			if (file_exists($dir.$file)) {
			$data_folder[] = $file;
			}
        }
        closedir($dh);
    }
}
echo end($data_folder);
echo date("Y-m-d H:i:s", filemtime($dir . end($data_folder)));
foreach($data_folder as $key){
    echo date("Y-m-d H:i:s", filemtime($dir . $key)) . '<br>';
}
?>