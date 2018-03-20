<?php
//$myfile = fopen("../auto/kuota/newfile.php", "w") or die("Unable to open file!");
//
$txt = "<?php\n\necho 'tes';\n\n?>";
//fwrite($myfile, $txt);
//fclose($myfile);

copy('../auto/kuota/cek_kuota_sbn_ras.php', '../auto/kuota/cron.php');
?>