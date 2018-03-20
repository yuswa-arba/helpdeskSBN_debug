<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    $id_ratecards	= (isset($_GET["id"]) ? $_GET["id"] : "");
    $act	= (isset($_GET["id"]) ? "Open Form Edit ratecards with id = $id_ratecards" : "Open Form ratecards");
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], $act);
    global $conn;
    global $conn_voip;
    
   
   
   if(isset($_POST["confirm_save"])){
	$tariffname	= isset($_POST["tariffname"]) ? trim(strip_tags($_POST["tariffname"])) : "";
	$startingdate	= isset($_POST["startingdate"]) ? trim(strip_tags($_POST["startingdate"])) : "";
	$expirationdate	= isset($_POST["expirationdate"]) ? trim(strip_tags($_POST["expirationdate"])) : "";
	$id_trunk	= isset($_POST["id_trunk"]) ? trim(strip_tags($_POST["id_trunk"])) : "";
	$description	= ($_POST["description"] !="") ? "'".trim(strip_tags($_POST["description"]))."'" : "NULL";
	$dnidprefix	= isset($_POST["dnidprefix"]) ? trim(strip_tags($_POST["dnidprefix"])) : "";
	$calleridprefix	= isset($_POST["calleridprefix"]) ? trim(strip_tags($_POST["calleridprefix"])) : "";
	
	if($tariffname != "")
	{
	    $sql	= "INSERT INTO `cc_tariffplan` (`id`, `iduser`, `tariffname`, `creationdate`, `startingdate`, `expirationdate`,
						    `description`, `id_trunk`, `secondusedreal`, `secondusedcarrier`, `secondusedratecard`,
						    `reftariffplan`, `idowner`, `dnidprefix`, `calleridprefix`)
						    VALUE ('', '0', '$tariffname', NOW(), '$startingdate', '$expirationdate',
						    $description, '$id_trunk', '0', '0', '0',
						    '0', '0', '$dnidprefix', '$calleridprefix')";
		//echo $sql;
		mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
				alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
			</script>");
		
		enableLog("", $loggedin["username"], $loggedin["id_employee"],"Insert data ratecards = $sql");
		echo "<script language='JavaScript'>
					alert('Data telah disimpan!');
					location.href = 'ratecards.php';
			</script>";
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
			</script>";
	}
	
   }
   elseif(isset($_POST["confirm_edit"]))
   {
	$tariffname	= isset($_POST["tariffname"]) ? trim(strip_tags($_POST["tariffname"])) : "";
	$startingdate	= isset($_POST["startingdate"]) ? trim(strip_tags($_POST["startingdate"])) : "";
	$expirationdate	= isset($_POST["expirationdate"]) ? trim(strip_tags($_POST["expirationdate"])) : "";
	$id_trunk	= isset($_POST["id_trunk"]) ? trim(strip_tags($_POST["id_trunk"])) : "";
	$description	= ($_POST["description"] !="") ? trim(strip_tags($_POST["description"])) : "NULL";
	$dnidprefix	= isset($_POST["dnidprefix"]) ? trim(strip_tags($_POST["dnidprefix"])) : "";
	$calleridprefix	= isset($_POST["calleridprefix"]) ? trim(strip_tags($_POST["calleridprefix"])) : "";
        
	if($id_ratecards != "" AND $tariffname != "")
	{
	    $sql	= "UPDATE `cc_tariffplan` SET `tariffname` = '".$tariffname."', `startingdate` = '".$startingdate."',`expirationdate` = '".$expirationdate."',
			   `id_trunk` = '".$id_trunk."', `description` = '".$description."', `dnidprefix` = '".$dnidprefix."', `calleridprefix` = '".$calleridprefix."'
			   WHERE `id` = '".$id_ratecards."';";
	    //echo $sql;
	    
	    mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	    
	    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data ratecards = $sql");
	   echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'ratecards.php';
		    </script>";
	}
	else
	{
		echo "<script language='JavaScript'>
				alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
				window.history.go(-1);
			</script>";
	}
   }
   
   $date_now		= gmdate("Y-m-d H:i:s");
   $count		= mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")+20);
   $date_exp		= gmdate("Y-m-d H:i:s", $count);
   $sql_ratecard        = mysql_query("SELECT * FROM `cc_tariffplan` WHERE `id` = '$id_ratecards'", $conn_voip);
   $row_ratecard	  = mysql_fetch_array($sql_ratecard);
   //echo "SELECT * FROM `cc_provider` WHERE `id` = '$id_provider'";
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Rate Cards Form</h2>
                                </div>

                                <div class="box-body table-responsive">
				    
				<form action="" id="ratecards_form" method="post" name="ratecards_form">
				    <table class="editform_table1" cellspacing="2" style="width:60%;display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
                                        <tbody><tr> 		
                                            <td width="15%" valign="middle" class="form_head"> TARIFFNAME </td>  
                                            <td width="85%" valign="top" class="tableBodyRight">
                                                <input class="form-control" name="tariffname" size="40" maxlength="30" value="'.(isset($_GET["id"]) ? $row_ratecard["tariffname"] : "").'"> 
                                                <span class="liens">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr> 		
                                            <td width="%25" valign="middle" class="form_head"> START DATE </td>  
                                            <td width="%75" valign="top" class="tableBodyRight">
                                                <input class="form-control" name="startingdate" size="40" maxlength="40" value="'.(isset($_GET["id"]) ? $row_ratecard["startingdate"] : $date_now).'"> 
                                                <span class="liens">
                                                </span>
                                                <br>Please use the format YYYY-MM-DD HH:MM:SS. For instance, \'2004-12-31 00:00:00\'                          
                                            </td>
                                        </tr>
                                        <tr> 		
                                            <td width="%25" valign="middle" class="form_head"> EXPIRY DATE </td>  
                                            <td width="%75" valign="top" class="tableBodyRight">
                                                <input class="form-control" name="expirationdate" size="40" maxlength="40" value="'.(isset($_GET["id"]) ? $row_ratecard["expirationdate"] : $date_exp).'"> 
                                                <span class="liens">
                                                </span>
                                                <br>Format YYYY-MM-DD HH:MM:SS. For instance, \'2004-12-31 00:00:00\'                          
                                            </td>
                                        </tr>
                                        <tr> 		
                                            <td width="%25" valign="middle" class="form_head"> TRUNK </td>  
                                            <td width="%75" valign="top" class="tableBodyRight">
                                                <select name="id_trunk" class="form-control">
                                                    ';
							$sql_select_trunk       = mysql_query("SELECT * FROM `cc_trunk` ORDER BY `id_trunk` ASC", $conn_voip);
							while($row_select_trunk = mysql_fetch_array($sql_select_trunk)){
							    $content .='<option value="'.$row_select_trunk["id_trunk"].'" '.((isset($_GET["id"] )&& ($row_select_trunk["id_trunk"] == $row_ratecard["id_trunk"])) ? 'selected=""' : "").'> '.$row_select_trunk["trunkcode"].'</option>';
							}
						    $content .='
                                                </select>
                                                <span class="liens">
                                                </span>
			                        
                                            </td>
                                        </tr>
                                        <tr> 		
                                            <td width="%25" valign="middle" class="form_head"> DESCRIPTION </td>  
                                            <td width="%75" valign="top" class="tableBodyRight">
                                                <textarea class="form-control" name="description" cols="100" rows="4">'.(isset($_GET["id"]) ? $row_ratecard["description"] : "").'</textarea> 
				                <span class="liens">
                                                </span>
			                        
                                            </td>
                                        </tr>
                                        <tr> 		
                                            <td width="%25" valign="middle" class="form_head"> DNID PREFIX </td>  
                                            <td width="%75" valign="top" class="tableBodyRight">
                                            <input class="form-control" name="dnidprefix" size="20" maxlength="20" value="'.(isset($_GET["id"]) ? $row_ratecard["dnidprefix"] : "all").'"> 
                                                <span class="liens">
                                                </span>
                                            <br>Set the DNID rules to choose the ratecard \'dnidprefix\', by default, matches all DNID. For instance, Set the DNIDPrefix  to 900540540 to choose this ratecard when the DNID is 900540540                          
                                            </td>
                                        </tr>
                                        <tr> 		
                                            <td width="%25" valign="middle" class="form_head"> CALLERID PREFIX </td>  
                                            <td width="%75" valign="top" class="tableBodyRight">
                                                <input class="form-control" name="calleridprefix" size="20" maxlength="20" value="'.(isset($_GET["id"]) ? $row_ratecard["calleridprefix"] : "all").'"> 
                                                <span class="liens">
                                                </span>
                                                <br>Set the CallerID rules to choose the ratecard \'calleridprefix\', by default, matches all callerID. For instance, Set the calleridprefix to 900540540 to choose this ratecard when the CallerID is 900540540.                          
                                            </td>
                                        </tr></tbody>
                                    </table>
				  <br />
				      <table width="100%" cellspacing="0" class="editform_table8">
					    <tbody><tr>
						    
						    <td align="right" valign="top" class="text">
							   <input class="btn btn-primary" name="'.(isset($_GET["id"]) ? "confirm_edit" : "confirm_save").'" value="Confirm Data" type="submit">
						    </td>
					    </tr>
				      </tbody></table>
				    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Provider List';
    $submenu	= "voip_provider";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>