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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    $id_callplan	= (isset($_GET["id"]) ? (int)$_GET["id"] : "");
    $act		= (isset($_GET["id"]) ? "Open Form Edit callplan with id = $id_callplan" : "Open Form callplan");
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], $act);
    global $conn;
    global $conn_voip;
    
   
   
if(isset($_POST["confirm_save"]))
{
	$tariffgroupname	= isset($_POST["tariffgroupname"]) ? trim(strip_tags($_POST["tariffgroupname"])) : "";
	$lcrtype			= isset($_POST["lcrtype"]) ? trim(strip_tags($_POST["lcrtype"])) : "";
	$id_cc_package_offer	= isset($_POST["id_cc_package_offer"]) ? trim(strip_tags($_POST["id_cc_package_offer"])) : "";
	$removeinterprefix	= isset($_POST["removeinterprefix"]) ? trim(strip_tags($_POST["removeinterprefix"])) : "";
	
	if($tariffgroupname != "")
	{
	    $sql	= "INSERT INTO `cc_tariffgroup` (`id`, `iduser`, `idtariffplan`, `tariffgroupname`,
						    `lcrtype`, `creationdate`, `removeinterprefix`, `id_cc_package_offer`)
						    VALUE (NULL, '0', '0', '".$tariffgroupname."', '".$lcrtype."', NOW(), '".$removeinterprefix."', '".$id_cc_package_offer."');";
															
	mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
	    </script>");
	//echo $sql;
	enableLog("", $loggedin["username"], $loggedin["id_employee"],"Input callplan = $sql");
	echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'call_plan.php';
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
	$tariffgroupname	= isset($_POST["tariffgroupname"]) ? trim(strip_tags($_POST["tariffgroupname"])) : "";
	$lcrtype			= isset($_POST["lcrtype"]) ? trim(strip_tags($_POST["lcrtype"])) : "";
	$id_cc_package_offer	= isset($_POST["id_cc_package_offer"]) ? trim(strip_tags($_POST["id_cc_package_offer"])) : "";
	$removeinterprefix	= isset($_POST["removeinterprefix"]) ? trim(strip_tags($_POST["removeinterprefix"])) : "";
	$id_callplan	= isset($_POST["id"]) ? trim(strip_tags($_POST["id"])) : "";
	
    if($id != "" AND $tariffgroupname != "")
	{
	
	    $sql	= "UPDATE `cc_tariffgroup` SET `tariffgroupname` = '".$tariffgroupname."', `lcrtype` = '".$lcrtype."',
		`id_cc_package_offer` = '".$id_cc_package_offer."', `removeinterprefix` = '".$removeinterprefix."'
			   WHERE `id` = '".$id_callplan."';";
	    //echo $sql;
	    mysql_query($sql, $conn_voip) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	    
	    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Edit callplan = $sql");
	    echo "<script language='JavaScript'>
				alert('Data telah disimpan!');
				location.href = 'call_plan.php';
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
   
   $sql_callplan    	= mysql_query("SELECT * FROM `cc_tariffgroup` WHERE `id` = '$id_callplan'", $conn_voip);
   $row_callplan	= mysql_fetch_array($sql_callplan);
   //echo "SELECT * FROM `cc_provider` WHERE `id` = '$id_provider'";
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title"></h2>
                                </div>

                                <div class="box-body table-responsive">
	
				<div class="box-header">
                                    <h3 class="box-title">Call Plan Form</h3>
                                </div><!-- /.box-header -->
				    
				<form action="" id="callplan_form" method="post" name="callplan_form">
				    <table cellspacing="2" width="100%" class="addform_table1" style="width:60%;display: table;border-collapse: separate;border-spacing: 2px;border-color: gray;">
					<tbody>
					    <tr>
						<td width="15%" valign="middle" class="form_head"> Name</td>  
						<td width="85%" valign="top" class="tableBodyRight">
						    <input class="form_input_text" name="tariffgroupname" size="45" maxlength="40" value="'.(isset($_GET["id"]) ? $row_callplan["tariffgroupname"] : "").'">
							<input type="hidden" name="id" size="45" maxlength="40" value="'.(isset($_GET["id"]) ? $row_callplan["id"] : "").'">
						    <span class="liens">
							    
							     </span> 
						    
						</td>
					    </tr>
					    <tr>
						<td width="15%" valign="middle" class="form_head"> LC Type</td>  
						<td width="85%" valign="top" class="tableBodyRight">
						    <select name="lcrtype" class="form_input_select">
							<option value="0" '.((isset($_GET["id"] )&& ($row_callplan["lcrtype"] == "0")) ? 'selected=""' : "").'> LCR : According to the buyer price</option>	
							<option value="1" '.((isset($_GET["id"] )&& ($row_callplan["lcrtype"] == "1")) ? 'selected=""' : "").'> LCD : According to the seller price</option>        
						    </select>
						    <span class="liens">
						    </span> 
						</td>
					    </tr>
					    <tr>
						<td width="15%" valign="middle" class="form_head"> Package</td>  
						<td width="85%" valign="top" class="tableBodyRight">
						    <select name="id_cc_package_offer" class="form_input_select">
							<option value="-1" '.((isset($_GET["id"] )&& ($row_callplan["id_cc_package_offer"] == "-1")) ? 'selected=""' : "").'>NO PACKAGE OFFER</option>
							';
							$sql_package_offer       = mysql_query("SELECT * FROM `cc_package_offer`", $conn_voip);
							while($row_package_offer = mysql_fetch_array($sql_package_offer)){
							    $content .='<option value="'.$row_package_offer["id"].'" '.((isset($_GET["id"] )&& ($row_package_offer["id"] == $row_callplan["id_cc_package_offer"])) ? 'selected=""' : "").'> '.$row_package_offer["label"].'</option>';
							}
							$content .='
						    </select>
						    <span class="liens">
						    <br />Set the Package Group offer if you wish to use one with this Call Plan         
						    </span> 
						</td>
					    </tr>
					    <tr>
			   			<td width="%25" valign="middle" class="form_head"> Remove Inter Prefix </td>  
						<td width="%75" valign="top" class="tableBodyRight">
						    Yes  <input type="radio" '.((isset($_GET["id"] )&& ($row_callplan["removeinterprefix"] == "1")) ? 'checked=""' : "").' name="removeinterprefix" value="1"> - No <input type="radio" name="removeinterprefix" value="0" '.((isset($_GET["id"] )&& ($row_callplan["removeinterprefix"] == "0")) ? 'checked=""' : "").'>
						    <span class="liens">
							</span> 
						    <br>Remove the international access prefix (00 or 011) before matching the dialled digits with the rate card. E.G. If the dialled digits were 0044 for a call to the UK, only 44 would be delivered.
						</td>
					    </tr>
								    
					    
				    </tbody>
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