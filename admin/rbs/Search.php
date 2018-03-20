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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    
	global $conn;
    $conn_soft = Config::getInstanceSoft();
    
    //paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
     
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
						<div class="box-header">
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body">
							<div class="row">
								<div class="col-lg-6 col-md-12 col-xs-12">
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											<label>AccountName</label>
										</div>
										<div class="col-xs-8">
											<select class="form-control" id="GroupName">
												<option value="">Pilih AccountName</option>';
	
	$sql_data = $conn_soft->prepare("SELECT * FROM dbo.AccountTypes ORDER BY dbo.AccountTypes.AccountName;");
	$sql_data->execute();
	while ($row_data = $sql_data->fetch())
	{
		$content .= '<option value="'.$row_data["AccountIndex"].'">'.$row_data["AccountName"].'</option>';
	}
	
	$content .= '
											</select>
										</div>
									
									</div>
									</div>
									
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											
										</div>
										<div class="col-xs-8">
											<input class="btn bg-olive btn-flat" id="search" value="Search" type="button">
										</div>
	
									</div>
									</div>
						
									<div id="result"></div>
									
									</div>									
									<div class="col-lg-6 col-md-12 col-xs-12">
										
										<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											<label>Dari AccountName</label>
										</div>
										<div class="col-xs-8">
											<select class="form-control" id="GroupName_from">
												<option value="">Pilih AccountName</option>';
	
	$sql_data = $conn_soft->prepare("SELECT * FROM dbo.AccountTypes ORDER BY dbo.AccountTypes.AccountName;");
	$sql_data->execute();
	while ($row_data = $sql_data->fetch())
	{
		$content .= '<option value="'.$row_data["AccountIndex"].'">'.$row_data["AccountName"].'</option>';
	}
	
	$content .= '
											</select>
										</div>
									
									</div>
									</div>
									
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											<label>Menjadi AccountName</label>
										</div>
										<div class="col-xs-8">
											<select class="form-control" id="GroupName_to">
												<option value="">Pilih AccountName</option>';
	
	$sql_data = $conn_soft->prepare("SELECT * FROM dbo.AccountTypes ORDER BY dbo.AccountTypes.AccountName;");
	$sql_data->execute();
	while ($row_data = $sql_data->fetch())
	{
		$content .= '<option value="'.$row_data["AccountIndex"].'">'.$row_data["AccountName"].'</option>';
	}
	
	$content .= '
											</select>
										</div>
									
									</div>
									</div>
									
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
											
										</div>
										<div class="col-xs-8">
											<input class="btn bg-olive btn-flat" id="changeto" value="Pindah AccountName" type="button">
										</div>
	
									</div>
									</div>
						
									<div id="result2"></div>
										
										
									</div>
									
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(){

                      var GroupName=$("#GroupName").val();

                      if(GroupName!=""){
                        $("#result").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                         $.ajax({
                            type:"GET",
                            url:"result.php",
                            data:"GroupName="+GroupName,
                            success:function(data){
                                $("#result").html(data);
                                $("#GroupName").val("");
                             }
                          });
                      }
                      
                 }
				 
				 function changeto(){

                      var GroupNameOld=$("#GroupName_from").val();
					  var GroupNameNew=$("#GroupName_to").val();

                      if(GroupNameOld !="" && GroupNameNew !=""){
                        $("#result2").html("<img src=\'/software/beta/img/ajax-loader.gif\'/>");
                         $.ajax({
                            type:"GET",
                            url:"changeto.php",
                            data:"GroupNameOld="+GroupNameOld+"&GroupNameNew="+GroupNameNew,
                            success:function(data){
                                $("#result2").html(data);
                             }
                          });
                      }
                      
                 }

                  $("#changeto").click(function(){
					if(confirm("Yakin melanjutkan proses?")){
                  	 changeto();
					}
                  });

                  $("#changeto").keyup(function(e) {
                     if(e.keyCode == 13) {
                        changeto();
                      }
                  });
				  
				  $("#search").click(function(){
                  	 search();
                  });

                  $("#search").keyup(function(e) {
                     if(e.keyCode == 13) {
                        search();
                      }
                  });
            });
        </script>
    ';

    $title	= 'Groups RBS';
    $submenu	= "group_rbs";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>