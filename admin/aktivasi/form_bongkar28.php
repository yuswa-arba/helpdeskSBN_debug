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
include '../../config/telnet/routeros_api.class.php';


redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){


global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form Bongkar ONU");


    $content =' <section class="content">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-xs-12">
							
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title ">Form Bongkar</h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
									<form action="ajax_/bongkar.php" method="POST" target="_blank" name="myForm" id="myForm"  enctype="multipart/form-data" >
                                    
									<div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <h5>SPK Bongkar</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <input type="text" readonly="" class="form-control" name="id_spkaktivasi" id="id_spkaktivasi" value="'.(isset($_POST["id_spkaktivasi"]) ? $_POST['id_spkaktivasi'] : "").'" >
                                                <input type="text" readonly="" class="form-control" name="id_teknisi" id="id_teknisi" value="'.(isset($_POST["id_teknisi"]) ? $_POST['id_teknisi'] : "").'" >
                                                <input type="text" readonly=""  placeholder="Pilih SPK Bongkar" class="form-control" name="kode_spkbongkar" id="kode_spkbongkar" value="'.(isset($_POST["kode_spkbongkar"]) ? $_POST['kode_spkbongkar'] : "").'"
												onclick="return valideopenerform(\'data_spkbongkar.php?r=myForm&f=spkbongkar\',\'spkbongkar\');">
												
                                            </div>
                                        </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <h5>Kode Customer</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <input type="text" readonly=""  placeholder="Pilih Kode Customer" class="form-control" name="kode_customer" id="kode_customer" value="'.(isset($_POST["kode_customer"]) ? $_POST['kode_customer'] : "").'"
												onclick="return valideopenerform(\'data_customer_bongkar.php?r=myForm&f=bongkar\',\'bongkar\');">
												
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <h5>Userid</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <input type="text" readonly=""  placeholder="Pilih Data Customer" class="form-control" name="userid" id="userid" value="'.(isset($_POST["userid"]) ? $_POST['userid'] : "").'"
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=bongkar\',\'bongkar\');">
												
                                            </div>
                                        </div>
                                        </div>
										
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <h5>OLT Server</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
												<input type="hidden" readonly="" class="form-control" name="id_olt" id="id_olt" value="'.(isset($_POST["id_olt"]) ? $_POST['id_olt'] : "").'" >
												<input type="text" readonly="" placeholder="Nama OLT" class="form-control" name="nama_olt" id="nama_olt" value="'.(isset($_POST["nama_olt"]) ? $_POST['nama_olt'] : "").'" >
                                                
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>PON</h5>
												</div>
												<div class="col-lg-4 col-md-3 col-xs-12">
													<input type="text" readonly="" placeholder="PON" class="form-control" name="pon" id="pon" maxlength="2" value="'.(isset($_POST["pon"]) ? $_POST['pon'] : "").'" >
													
												</div>
												
												<div class="col-lg-4 col-md-3 col-xs-12">
													<input type="text" readonly="" placeholder="PON ID" class="form-control" name="id" id="id" maxlength="2" value="'.(isset($_POST["id"]) ? $_POST['id'] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>VLAN</h5>
												</div>
												<div class="col-lg-8 col-md-6 col-xs-12">
													<input type="text" readonly="" placeholder="VLAN" class="form-control" name="vlan" id="vlan" value="'.(isset($_POST["vlan"]) ? $_POST['vlan'] : "").'">
												</div>
												
											</div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>IP VLAN</h5>
												</div>
												<div class="col-lg-8 col-md-6 col-xs-12">
													<input type="text" readonly="" placeholder="IP VLAN" class="form-control" name="ip_vlan" id="ip_vlan" value="'.(isset($_POST["ip_vlan"]) ? $_POST['ip_vlan'] : "").'">
												</div>
												
											</div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>IP Internet</h5>
												</div>
												<div class="col-lg-8 col-md-6 col-xs-12">
													<input type="text" readonly="" placeholder="IP Address" class="form-control" name="ip_inet" id="ip_inet" min-length="20" value="'.(isset($_POST["ip_inet"]) ? $_POST['ip_inet'] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>MAC ADDRESS ONU</h5>
												</div>
												<div class="col-lg-8 col-md-6 col-xs-12">
													<input type="text" readonly="" placeholder="MAC Address" class="form-control" name="mac_address" id="mac_address" min-length="14" value="'.(isset($_POST["mac_address"]) ? $_POST['mac_address'] : "").'">
												</div>
												
											</div>
                                        </div>
										
										<div class="form-group" hidden>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <h5>Tim Pasang</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <select class="form-control" name="id_timpasang" id="id_timpasang">';
												
$sql_olt = mysql_query("SELECT * FROM `gx_timpasang` WHERE `level` = '0' ORDER BY `id_timpasang` ASC", $conn);
while($row_olt = mysql_fetch_array($sql_olt)){
	$selected = isset($_POST["id_timpasang"]) ? $_POST["id_timpasang"] : "";
	$selected = ($selected == $row_olt["id_timpasang"]) ? ' selected=""' : "";
	
	$content .= '<option value="'.$row_olt["id_timpasang"].'" '.$selected.'>'.$row_olt["namapegawai_timpasang"].'</option>';
	
}
						
						
						$content .= '
                                            </select>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
											<div class="row">        
												<div class="col-xs-12">
													&nbsp;
												</div>
											</div>
                                        </div>
										
										
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-12">
													<button type="button" id="bongkar" name="bongkar" class="btn btn-danger">Proses</button>
                                                    <button type="submit" id="submit" name="submit" class="btn btn-danger">Proses Submit</button>
                                                    
												</div>
											</div>
                                        </div>
									
										<hr>
								
                                
                                <div id="result"></div>
							</form>
									</div><!-- /.box-body -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        
                        <div class="col-lg-5 col-md-12 col-xs-12">
                                <form action="ajax_/bongkar28.php" method="POST">
<table>
<tr>
<td>First Name:</td>
<td><input type="text" name="first" id="first"></td>
</tr>
<tr>
<td>Last Name:</td>
<td><input type="text" name="last" id="last"></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" name="email" id="email"></td>
</tr>
<tr>
<td>Minecraft Name:</td>
<td><input type="text" name="user"></td>
</tr>
<tr>
<td><input type="submit" name="Send" value="Send"></td>
<td><input type="reset" name="Reset" value="Reset"></td>
</tr>
</table>
</form>
                        <div>
                        
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        $(function() {
                $("[data-mask]").inputmask();
            });

        </script>
        
        <script type="text/javascript">
            $(document).ready(function()
			{
                 
                function bongkar(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/bongkar.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                 
				  
                    $( "body" ).delegate( "#bongkar", "click", function() {
                        bongkar();
                    });
                  
            });
        </script>
    ';

    $title	= 'Form Bongkar';
    $submenu	= "inet_olt_customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }