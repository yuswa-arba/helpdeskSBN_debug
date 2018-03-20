<?php
include ("../../config/configuration_admin.php");

global $conn;

$page = $_SERVER['PHP_SELF'];
$sec = "300";

$sql_insert = "INSERT INTO `MessageOut` (`Id`, `MessageTo`, `MessageFrom`, `MessageText`, `MessageType`, `Gateway`, `UserId`, `UserInfo`, `Priority`, `Scheduled`, `IsSent`, `IsRead`)
VALUES (NULL, '+6285646867538', '', 'WHERE#', 'sms', NULL, NULL, NULL, '0', NULL, '0', '0');";

mysql_query($sql_insert, $conn);

?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        echo "send sms OK";
    ?>
    </body>
</html>


