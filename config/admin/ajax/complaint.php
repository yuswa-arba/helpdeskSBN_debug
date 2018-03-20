<?php
include ("../config/configuration.php");
sleep(1.2);
if(isset($_GET["q"])){
    $q = isset($_GET["q"]) ? strip_tags($_GET["q"]) : "";
    
    if($q=="today"){
?>
<small id="dummy-time" class="pad pull-right text-muted"></small>
<small class="pull-right pad text-muted">Last update:</small>

    <table id="example1" class="table table-bordered table-hover">
        <tbody><tr>
            <th style="width: 10px">#</th>
            <th>UserID</th>
            <th>Ticket Number</th>
            <th>Spk Number</th>
            <th>Teknisi</th>
            <th>Status</th>
        </tr>
<?php
    $date_sql = date("Y-m-d"); //getdate converted day
    $sql_complaint_today = "SELECT `gx_complaint`.`id_complaint`, `gx_complaint`.`ticket_number`, `gx_complaint`.`name`, `gx_complaint`.`cust_number`, `gx_complaint`.`status`
			    FROM `gx_complaint`
			    WHERE `gx_complaint`.`status` = 'open'
                            AND `gx_complaint`.`date_add` LIKE '%$date_sql%'
			    AND `gx_complaint`.`level` = '0' 
			    ORDER BY `gx_complaint`.`date_add` DESC LIMIT 0,10;";
			    //echo $sql_complaint_today;
    $query_complaint_today = mysql_query($sql_complaint_today);

$noToday = 1;
while($row_complaint_today = mysql_fetch_array($query_complaint_today)){
    $sql_spk = mysql_query("SELECT `gx_spk`.*, `gx_employee`.`id_employee`, `gx_employee`.`first_name` FROM `gx_spk`, `gx_employee`
                           WHERE `gx_spk`.`id_teknisi` = `gx_employee`.`id_employee`
                           AND `gx_spk`.`level` = '0'
                           AND `gx_spk`.`id_trouble_ticket` = '".$row_complaint_today["ticket_number"]."' LIMIT 0,1;");
    $row_spk = mysql_fetch_array($sql_spk);
    $sum_spk = mysql_num_rows($sql_spk);
    
    echo '<tr>
            <td>'.$noToday.'.</td>
            <td><a href="info.php?idC='.str_replace(' ', '', $row_complaint_today["cust_number"]).'" onclick="return valideopenerform(\'info.php?idC='.str_replace(' ', '', $row_complaint_today["cust_number"]).'\',\'customer'.$row_complaint_today["id_complaint"].'\');">'.$row_complaint_today["name"].'</a></td>
            <td><a href="info.php?idT='.str_replace(' ', '', $row_complaint_today["ticket_number"]).'" onclick="return valideopenerform(\'info.php?idT='.str_replace(' ', '', $row_complaint_today["ticket_number"]).'\',\'ticket'.$row_complaint_today["id_complaint"].'\');">'.$row_complaint_today["ticket_number"].'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'"  onclick="return valideopenerform(\'info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'\',\'spk'.$row_spk["id_spk"].'\');">'.$row_spk["spk_number"].'</a>' : "-").'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'"  onclick="return valideopenerform(\'info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'\',\'teknisi'.$row_spk["id_spk"].'\');">'.$row_spk["first_name"].'</a>' : "-").'</td>
            
            <td>'.$row_complaint_today["status"].'</td>
        </tr>';
        $noToday++;
}
?>
            
</tbody></table>


<script type="text/javascript">
    var now = new Date();
    var strDateTime = [[AddZero(now.getDate()), AddZero(now.getMonth() + 1), now.getFullYear()].join("/"), [AddZero(now.getHours()), AddZero(now.getMinutes())].join(":"), now.getHours() >= 12 ? "PM" : "AM"].join(" ");

    //Pad given value to the left with "0"
    function AddZero(num) {
        return (num >= 0 && num < 10) ? "0" + num : num + "";
    }
    var x = document.getElementById("dummy-time");
    x.innerHTML = strDateTime;
</script>

<?php
    }elseif($q=="tomorrow"){

?>
<small id="dummy-time" class="pad pull-right text-muted"></small>
<small class="pull-right pad text-muted">Last update:</small>

    <table id="example1" class="table table-bordered table-hover">
        <tbody><tr>
            <th style="width: 10px">#</th>
            <th>UserID</th>
            <th>Ticket Number</th>
            <th>Spk Number</th>
            <th>Teknisi</th>
            <th>Status</th>
        </tr>
<?php
    $date_sql = date("Y-m-d"); //getdate converted day
    $sql_complaint_tomorrow = "SELECT `gx_complaint`.`id_complaint`, `gx_complaint`.`ticket_number`, `gx_complaint`.`name`, `gx_complaint`.`cust_number`, `gx_complaint`.`status`
			    FROM `gx_complaint`
			    WHERE `gx_complaint`.`status` = 'open'
			    AND `gx_complaint`.`date_execution` = CURDATE() + INTERVAL 1 DAY
			    AND `gx_complaint`.`action` = 'tomorrow'
			    ORDER BY `gx_complaint`.`date_add` DESC LIMIT 0,10;";
    $query_complaint_tomorrow = mysql_query($sql_complaint_tomorrow);


$noTomorrow = 1;
while($row_complaint_tomorrow = mysql_fetch_array($query_complaint_tomorrow)){
	    
    $sql_spk = mysql_query("SELECT `gx_spk`.*, `gx_employee`.`id_employee`, `gx_employee`.`first_name`
                           FROM `gx_spk`, `gx_employee`
                           WHERE `gx_spk`.`id_teknisi` = `gx_employee`.`id_employee`
                           AND `gx_spk`.`level` = '0'
                           AND `gx_spk`.`id_trouble_ticket` = '".$row_complaint_tomorrow["ticket_number"]."' LIMIT 0,1;");
    $row_spk = mysql_fetch_array($sql_spk);
    $sum_spk = mysql_num_rows($sql_spk);
    $content .='<tr>
            <td>'.$noTomorrow.'.</td>
            <td><a href="info.php?idC='.str_replace(' ', '', $row_complaint_tomorrow["cust_number"]).'" onclick="return valideopenerform(\'info.php?idC='.str_replace(' ', '', $row_complaint_tomorrow["cust_number"]).'\',\'customer'.$row_complaint_tomorrow["id_complaint"].'\');">'.$row_complaint_tomorrow["name"].'</a></td>
            <td><a href="info.php?idT='.str_replace(' ', '', $row_complaint_tomorrow["ticket_number"]).'" onclick="return valideopenerform(\'info.php?idT='.str_replace(' ', '', $row_complaint_tomorrow["ticket_number"]).'\',\'ticket'.$row_complaint_tomorrow["id_complaint"].'\');">'.$row_complaint_tomorrow["ticket_number"].'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'"  onclick="return valideopenerform(\'info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'\',\'spk'.$row_spk["id_spk"].'\');">'.$row_spk["spk_number"].'</a>' : "-").'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'"  onclick="return valideopenerform(\'info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'\',\'teknisi'.$row_spk["id_spk"].'\');">'.$row_spk["first_name"].'</a>' : "-").'</td>
            
            <td>'.$row_complaint_tomorrow["status"].'</td>
        </tr>';
        $noTomorrow++;
}
?>
        </tbody></table>


<script type="text/javascript">
    var now = new Date();
    var strDateTime = [[AddZero(now.getDate()), AddZero(now.getMonth() + 1), now.getFullYear()].join("/"), [AddZero(now.getHours()), AddZero(now.getMinutes())].join(":"), now.getHours() >= 12 ? "PM" : "AM"].join(" ");

    //Pad given value to the left with "0"
    function AddZero(num) {
        return (num >= 0 && num < 10) ? "0" + num : num + "";
    }
    var x = document.getElementById("dummy-time");
    x.innerHTML = strDateTime;
</script>

<?php
    }elseif($q=="pending"){
    
    

?>
<small id="dummy-time" class="pad pull-right text-muted"></small>
<small class="pull-right pad text-muted">Last update:</small>

    <table id="example1" class="table table-bordered table-hover">
        <tbody><tr>
            <th style="width: 10px">#</th>
            <th>UserID</th>
            <th>Ticket Number</th>
            <th>Spk Number</th>
            <th>Teknisi</th>
            <th>Status</th>
        </tr>
<?php
    $date_sql = date("Y-m-d"); //getdate converted day
    $sql_complaint_pending = "SELECT `gx_complaint`.`id_complaint`, `gx_complaint`.`ticket_number`, `gx_complaint`.`name`, `gx_complaint`.`cust_number`, `gx_complaint`.`status`
			    FROM `gx_complaint`
			    WHERE `gx_complaint`.`status` = 'open'
			    AND `gx_complaint`.`date_add` NOT LIKE '%$date_sql%'
			    ORDER BY `gx_complaint`.`date_add` DESC LIMIT 0,10;";
			    //echo $sql_complaint_pending;
    $query_complaint_pending = mysql_query($sql_complaint_pending);

$no = 1;
while($row_complaint_pending = mysql_fetch_array($query_complaint_pending)){

    $sql_spk = mysql_query("SELECT `gx_spk`.*, `gx_employee`.`id_employee`, `gx_employee`.`first_name` FROM `gx_spk`, `gx_employee`
                           WHERE `gx_spk`.`id_teknisi` = `gx_employee`.`id_employee`
                           AND `gx_spk`.`level` = '0'
                           AND `gx_spk`.`id_trouble_ticket` = '".$row_complaint_pending["ticket_number"]."' LIMIT 0,1;");
    $row_spk = mysql_fetch_array($sql_spk);
    $sum_spk = mysql_num_rows($sql_spk);
    echo '<tr>
            <td>'.$no.'.</td>
            <td><a href="info.php?idC='.str_replace(' ', '', $row_complaint_pending["cust_number"]).'" onclick="return valideopenerform(\'info.php?idC='.str_replace(' ', '', $row_complaint_tomorrow["cust_number"]).'\',\'customer'.$row_complaint_pending["id_complaint"].'\');">'.$row_complaint_pending["name"].'</a></td>
            <td><a href="info.php?idT='.str_replace(' ', '', $row_complaint_pending["ticket_number"]).'" onclick="return valideopenerform(\'info.php?idT='.str_replace(' ', '', $row_complaint_tomorrow["ticket_number"]).'\',\'ticket'.$row_complaint_pending["id_complaint"].'\');">'.$row_complaint_pending["ticket_number"].'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'"  onclick="return valideopenerform(\'info.php?idS='.str_replace(' ', '', $row_spk["spk_number"]).'\',\'spk'.$row_spk["id_spk"].'\');">'.$row_spk["spk_number"].'</a>' : "-").'</a></td>
            <td>'.(($sum_spk == 1) ? '<a href="info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'"  onclick="return valideopenerform(\'info.php?idTech='.str_replace(' ', '', $row_spk["id_employee"]).'\',\'teknisi'.$row_spk["id_spk"].'\');">'.$row_spk["first_name"].'</a>' : "-").'</td>
            
            <td><span class="label label-danger">'.$row_complaint_pending["status"].'</span></td>
        </tr>';
        $no++;
}

?>
        </tbody></table>


<script type="text/javascript">
    var now = new Date();
    var strDateTime = [[AddZero(now.getDate()), AddZero(now.getMonth() + 1), now.getFullYear()].join("/"), [AddZero(now.getHours()), AddZero(now.getMinutes())].join(":"), now.getHours() >= 12 ? "PM" : "AM"].join(" ");

    //Pad given value to the left with "0"
    function AddZero(num) {
        return (num >= 0 && num < 10) ? "0" + num : num + "";
    }
    var x = document.getElementById("dummy-time");
    x.innerHTML = strDateTime;
</script>

<?php
    }

}else{
    header("location:../index.php");
}