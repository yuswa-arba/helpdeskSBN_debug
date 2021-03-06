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
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form OLT Customer");


    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
							
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Ganti Onu</h3>
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
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Userid</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly=""  placeholder="Pilih Data Customer" class="form-control" name="userid" id="userid" value="'.(isset($_POST["userid"]) ? $_POST['userid'] : "").'"
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
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
													<h5>IP Internet</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" readonly="" placeholder="IP Address" class="form-control" name="ip_inet" id="ip_inet" min-length="20" value="'.(isset($_POST["ip_inet"]) ? $_POST['ip_inet'] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC ADDRESS ONU LAMA</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" readonly="" placeholder="MAC Address LAMA" class="form-control" name="mac_address" id="mac_address" min-length="14" value="'.(isset($_POST["mac_address"]) ? $_POST['mac_address'] : "").'">
												</div>
												
											</div>
                                        </div>
                                        
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC ADDRESS ONU BARU</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" placeholder="MAC Address BARU" class="form-control" name="mac_address_baru" id="mac_address_baru" min-length="14" value="'.(isset($_POST["mac_address_baru"]) ? $_POST['mac_address_baru'] : "").'">
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
												<div class="col-xs-3">
													<h5>ONU Tipe</h5>
												</div>
												<div class="col-xs-3">
													<input type="radio" id="onu_tipe" name="onu_tipe" checked="" value="baru" class="minimal" '.(isset($_POST["tv"]) ? 'checked=""' : "").'> Baru
												</div>
												<div class="col-xs-3">
													<input type="radio" id="onu_tipe" name="onu_tipe" value="lama" class="minimal" '.(isset($_POST["voip"]) ? 'checked=""' : "").'> Lama
												</div>
											</div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-12 text-center">
													<button type="button" id="gantionu" name="gantionu" class="btn btn-success">Ganti Onu</button>
                                                    
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
                 
                function gantionu(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/ganti_onu.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                 
                 
				  $("#gantionu").click(function(){
                  	 gantionu();
                  });

                  $("#gantionu").keyup(function(e) {
                     if(e.keyCode == 13) {
                        gantionu();
                      }
                  });
                  
                  
            });
        </script>
    ';

    $title	= 'Form Ganti ONU';
    $submenu	= "inet_gantionu";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }