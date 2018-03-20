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
                        <div class="col-lg-7 col-md-12 col-xs-12">
							
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title ">Form Aktivasi</h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
									<form role="form" method="" name="myForm" id="myForm" action="#" enctype="multipart/form-data" >
                                    
									<div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <h5>SPK Aktivasi</h5>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-xs-12">
                                                <input type="text" readonly="" class="form-control" name="id_spkaktivasi" id="id_spkaktivasi" value="'.(isset($_POST["id_spkaktivasi"]) ? $_POST['id_spkaktivasi'] : "").'" >
                                                <input type="text" readonly="" class="form-control" name="id_teknisi" id="id_teknisi" value="'.(isset($_POST["id_teknisi"]) ? $_POST['id_teknisi'] : "").'" >
                                                <input type="text" readonly=""  placeholder="Pilih SPK Aktivasi" class="form-control" name="kode_spkaktivasi" id="kode_spkaktivasi" value="'.(isset($_POST["kode_spkaktivasi"]) ? $_POST['kode_spkaktivasi'] : "").'"
												onclick="return valideopenerform(\'data_spkaktivasi.php?r=myForm&f=spkaktivasi\',\'spkaktivasi\');">
												
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
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
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
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
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
										
										<div class="form-group">
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
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>PAKET TV</h5>
												</div>
												<div class="col-lg-8 col-md-6 col-xs-12">
													<input type="checkbox" id="tv" name="tv" value="tv" class="minimal" '.(isset($_POST["tv"]) ? 'checked=""' : "").'>
												</div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
											<div class="row">        
												<div class="col-lg-4 col-md-6 col-xs-12">
													<h5>PAKET VOIP</h5>
												</div>
												<div class="col-lg-8 col-md-6 col-xs-12">
													<input type="checkbox" id="voip" name="voip" value="voip" class="minimal" '.(isset($_POST["voip"]) ? 'checked=""' : "").'>
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
													<button type="button" id="step1" name="step1" class="btn btn-success">Register Onu Test</button>
                                                    <button type="button" id="cekpower" name="cekpower" class="btn btn-success">Cek Power ONU</button>
												
												</div>
											</div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-12">
													
													<button type="button" id="config_onu" name="config_onu" class="btn btn-warning">Step 2 (CONFIG ONU + POWER ON VM)</button>
                                                    <button type="button" id="cek_dhcp" name="cek_dhcp" class="btn btn-warning">Step 2 (CEK DHCP LEASE)</button>
												
												</div>
											</div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-12">
													<button type="button" id="aktifasi" name="aktifasi" class="btn btn-danger">Step 3 (AKTIFASI)</button>
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
                            <!-- DIRECT CHAT -->
				<div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Direct Chat</h3>

                  <div class="box-tools pull-right">
                    <!--<span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button>-->
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
					
					<div id="result_chat"></div>
                    
                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="/staff/assets/dist/img/user1-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Teknisi
                                  <small class="contacts-list-date pull-right">'.date("d-m-Y").'</small>
                                </span>
                            <span class="contacts-list-msg">Message</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      
                    </ul>
                    <!-- /.contatcts-list -->
                  </div>
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <form role="form" method="" name="myFormChat" id="myFormChat" action="#" enctype="multipart/form-data" >
                    <div class="input-group">
                      <input type="text" name="message_chat" id="message_chat" placeholder="Type Message ..." class="form-control">
                          <span class="input-group-btn">
                            <button type="button" name="submit_chat" id="submit_chat" class="btn btn-warning btn-flat">Send</button>
                          </span>
                    </div>
                  </form>
                </div>
                <!-- /.box-footer-->
              </div>
				<!--/.direct-chat -->
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Interaksi Teknisi Lapangan</h3>
                                </div>
                                <div class="box-body">
                                    <div id="result_response"></div>
                                    <img src="/software/beta/img/ajax-loader.gif"><br>
                                    Menunggu Konfirmasi Teknisi
                                </div>
                            </div>
                                
                        
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
                 
                function step1(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/step1.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                 
                 function cekpower(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/cekpower.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                 
                 function configOnu(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/config_onu.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                function cekDhcp(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/cek_dhcp.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                 
                 function aktifasi(){
                    var userid=$("#userid").val();
                      if(userid!="")
					  {
						$("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                        $.ajax({
                            type:"GET",
                            url:"ajax_/aktivasi.php",
							data: $("#myForm").serialize(),
                            success:function(data){
                                $("#result").html(data);
                             }
                          });
                      }                      
                 }
                 
                 function submitChat(){
                    var chat=$("#message_chat").val();
                    var datachat = {
                            chat: $("#message_chat").val(),
                            idspk_aktivasi: $("#id_spkaktivasi").val(),
                            idteknisi: $("#id_teknisi").val()
                        };
                      if(chat!="")
					  {
                      
                        $.ajax({
                            type:"GET",
                            url:"ajax_/chat.php",
							data: datachat,
                           
                            success:function(data){
                                $("#message_chat").val("");
                             }
                          });
                      }                      
                 }
				  
                    $( "body" ).delegate( "#step1", "click", function() {
                        step1();
                    });
                    $( "body" ).delegate( "#cekpower", "click", function() {
                        cekpower();
                    });
                    $( "body" ).delegate( "#config_onu", "click", function() {
                        configOnu();
                    });
                    $( "body" ).delegate( "#cek_dhcp", "click", function() {
                        cekDhcp();
                    });
                    $( "body" ).delegate( "#aktifasi", "click", function() {
                        aktifasi();
                    });
                    
                    $( "body" ).delegate( "#submit_chat", "click", function() {
                        submitChat();
                    });
                    
                    $("#message_chat").keydown(function (e){
                        if(e.keyCode == 13){
                            submitChat();
                        }
                    })
                  
            });
        </script>
        
<script type="text/javascript">
    $(function () {
    
    function showChat()
    {
        var datachat = {
            idspk_aktivasi: $("#id_spkaktivasi").val(),
            idteknisi: $("#id_teknisi").val()
        };
        $.ajax({
            type:"GET",
            url:"ajax_/response.php",
            data: datachat,
           
            success:function(data){                
                $("#result_chat").html(data);
            }
        });
    }
    
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            showChat();
        }, 1000); 
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