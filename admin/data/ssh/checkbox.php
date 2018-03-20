<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");
include '../../../config/telnet/routeros_api.class.php';


redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){


global $conn;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form OLT Customer");


    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
							
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Aktivasi</h3>
									<hr>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form role="form" method="POST" name="myForm" id="myForm" action="" enctype="multipart/form-data" >
                                    
									<div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Kode Customer</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly=""  placeholder="Pilih Kode Customer" class="form-control" name="kode_customer" id="kode_customer" value="'.(isset($_POST["kode_customer"]) ? $_POST['kode_customer'] : "").'"
												onclick="return valideopenerform(\'../data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Userid</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly=""  placeholder="Pilih Data Customer" class="form-control" name="userid" id="userid" value="'.(isset($_POST["userid"]) ? $_POST['userid'] : "tes").'"
												onclick="return valideopenerform(\'../data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
                                            </div>
                                        </div>
                                        </div>
										
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>OLT Server</h5>
                                            </div>
                                            <div class="col-xs-6">
												<input type="hidden" readonly="" class="form-control" name="id_olt" id="id_olt" value="'.(isset($_POST["id_olt"]) ? $_POST['id_olt'] : "").'" >
												<input type="text" readonly="" placeholder="Nama OLT" class="form-control" name="nama_olt" id="nama_olt" value="'.(isset($_POST["nama_olt"]) ? $_POST['nama_olt'] : "").'" >
                                                
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>PON</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" readonly="" placeholder="PON" class="form-control" name="pon" id="pon" maxlength="2" value="'.(isset($_POST["pon"]) ? $_POST['pon'] : "").'" >
													
												</div>
												
												<div class="col-xs-3">
													<input type="text" readonly="" placeholder="PON ID" class="form-control" name="id" id="id" maxlength="2" value="'.(isset($_POST["id"]) ? $_POST['id'] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>VLAN</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" readonly="" placeholder="VLAN" class="form-control" name="vlan" id="vlan" value="'.(isset($_POST["vlan"]) ? $_POST['vlan'] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC ADDRESS ONU</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" readonly="" placeholder="MAC Address" class="form-control" name="mac_address" id="mac_address" min-length="14" value="'.(isset($_POST["mac_address"]) ? $_POST['mac_address'] : "").'">
												</div>
												
											</div>
                                        </div>
										
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
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
												<div class="col-xs-3">
													<h5>PAKET TV</h5>
												</div>
												<div class="col-xs-3">
													<input type="checkbox" id="tv" name="tv" value="tv" class="minimal" '.(isset($_POST["tv"]) ? 'checked=""' : "").'>
												</div>
                                                
												<div class="col-xs-3">
													<h5>PAKET VOIP</h5>
												</div>
												<div class="col-xs-3">
													<input type="checkbox" id="voip" name="voip" value="voip" class="minimal" '.(isset($_POST["voip"]) ? 'checked=""' : "").'>
												</div>
											</div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-12 text-center">
													<button type="button" id="step1" name="step1" class="btn btn-success">Register Onu Test</button>
												</div>
											</div>
                                        </div>
									</form>
										
									<div id="result"></div>
							
									</div><!-- /.box-body -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';
//data: "kode_customer="+kode_customer+"&userid="+userid+"&id_olt="+id_olt+"&pon="+pon+"&id="+id+"&vlan="+vlan+"&mac_address="+mac_address+"&id_timpasang="+id_timpasang+"&tv="+tv+"&voip="+voip,
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
                 
                 function step1(){
                      var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"result.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
				  
				  $("#step1").click(function(){
                  	 step1();
                  });

                  $("#step1").keyup(function(e) {
                     if(e.keyCode == 13) {
                        step1();
                      }
                  });
            });
        </script>
    ';

		$title	= 'Form Aktivasi';
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