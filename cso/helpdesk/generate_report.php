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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Generate Report");
     global $conn;
     //echo $loggedin["id_level"];
     $content ='<section class="content-header">
		     <h1>
			Generate Report
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 
		 <section class="content">
		     <div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Laporan Harian</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" name="form_generate"  method="POST" action="">
                    <div class="box-body">
					
                        <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                            <label>Tanggal</label>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" name="date" id="date" value="'.date("Y-m-d").'">
                            </div>
                        </div>
                        </div>
					
					
					
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" name="search_date" value="Generate" />
                    </div>
                </form>
            </div><!-- /.box -->
                </div>
		     </div>';
			 
if($loggedin["id_level"] == "admin")
{
	
	$content .='<div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Laporan Bulanan</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" name="form_generate"  method="POST" action="">
                    <div class="box-body">
					
                        <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                            <label>Bulan</label>
                            </div>
                            <div class="col-xs-3">
                                <select name="bulan">
									<option value="01">Januari</option>
									<option value="02">Februari</option>
									<option value="03">Maret</option>
									<option value="04">April</option>
									<option value="05">Mei</option>
									<option value="06">Juni</option>
									<option value="07">Juli</option>
									<option value="08">Agustus</option>
									<option value="09">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
                            </div>
							<div class="col-xs-3">
                            <label>Tahun</label>
                            </div>
                            <div class="col-xs-3">
                                <select name="tahun">
									<option value="2013">2013</option>
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
								</select>
                            </div>
                        </div>
                        </div>
						<div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                            <label>CSO</label>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" name="cso"  value="">
                            </div>
                        </div>
                        </div>
					
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" name="search_date" value="Generate" />
                    </div>
                </form>
            </div><!-- /.box -->
                </div>
		     </div>';
	
}

$content .='
 
		 </section><!-- /.content -->
	     ';

if(isset($_POST["search_date"])){
    
    $date	= isset($_POST["date"]) ? $_POST["date"] : "";
    $id     = $loggedin["id_employee"];
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "generate report id = $id ; tanggal = $date");
    
    //header( "location : gen.php?id=$id&tgl=$date");
    echo "<script language='JavaScript'>
			
			//location.href = 'gen.php?id=".$id."&tgl=".$date."';
            window.open('gen.php?id=".$id."&tgl=".$date."', '_blank');
		</script>";
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
        </script>
    ';

    $title	= 'Generate Report';
    $submenu	= "gen_report";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>