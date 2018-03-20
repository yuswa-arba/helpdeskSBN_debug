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
            
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Data Usage</h3>
                                    <div class="box-tools pull-right">
                                        
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <div id="cek_bw">
                                    
                                <table class="table table-hover table-border">
                                        <thead>
                                        <tr>
                                            <th><b>No</b></th>
                                            <th><b>UserIndex</b></th>
                                            <th><b>AccountName</b></th>
                                            <th><b>UserID</b></th>
                                            <th><b>Sisa Kuota</b></th>
                                            <th><b>Session In</b></th>
                                            <th><b>Session Out</b></th>
                                            <th><b>Total</b></th>
                                            
                                            <th><b>GroupName</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                ';
//enableLog("","dwi", "dwi","cek bw");

$no = 1;
$conn_soft = Config::getInstanceSoft();


$sql_all_user = $conn_soft ->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
                                     FROM [dbo].[Users], [dbo].[AccountTypes]
                                     WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
                                     AND [Users].[userActive] = '1';");
$sql_all_user->execute();

$kondisi1 = 'bw.5';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi2 = 'bw.4';
$kondisi3 = 'bw.3';
$kondisi4 = 'bw.2';
$kondisi5 = 'bw.1';

$row_all_user = $sql_all_user->fetchAll(PDO::FETCH_ASSOC);

foreach ($row_all_user as $rows)
{
//total pemakaian
$conn_soft2 = Config::getInstanceSoft();
$sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin, ISNULL([AcctInputOctets], 0) AS totalout
                        FROM [4RBSSQL].[dbo].[Accountinglog]
                        WHERE  [Accountinglog].[UserId] = '".$rows["UserID"]."'
                        AND MONTH(AcctDate) = ".date("m")." AND YEAR(AcctDate) = ".date("Y").";");

/*
 *
 *SELECT  [Accountinglog].[AcctOutputOctets], [Accountinglog].[AcctInputOctets]
  FROM [dbo].[Accountinglog]
  WHERE [Accountinglog].[UserId] = '".$rows["UserID"]."'
  AND [Accountinglog].[AcctDate] BETWEEN '2014-09-01 00:00:00' AND '2014-09-31 23:59:59';
  *
  *
  *
  *
  
 *WHERE [Accountinglog].[UserId] = 'test001'
AND[Accountinglog].[AcctDate] >= '2014-09-01 00:00:00.000' 
AND [Accountinglog].[AcctDate] <= '2014/09/31 23:59:59.999'
 */
$sql_total_data->execute();


$total_kuota = 0;
$totalin = 0;
$totalout = 0;
$bw = '-';

$row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);

foreach($row_total_data as $kuota){
    $totalin = $totalin + ($kuota["totalin"]);
    $totalout = $totalout + ($kuota["totalout"]);
    $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
    
}
    if((strpos($rows["GroupName"], "bw.5")) !== FALSE){
        $bw = "5Mbps";
    }elseif((strpos($rows["GroupName"], "bw.4")) !== FALSE){
        $bw = "4Mbps";
    }elseif((strpos($rows["GroupName"], "bw.3")) !== FALSE){
        $bw = "3Mbps";
    }elseif((strpos($rows["GroupName"], "bw.2")) !== FALSE){
        $bw = "2Mbps";
    }elseif((strpos($rows["GroupName"], "bw.1")) !== FALSE){
        $bw = "1Mbps";
    }
    
    $max_kuota = kuotaKB($rows["UserKBBank"]);
    
    $content .='<tr>
                <td>'.$no.'.</td>
                <td>'.$rows["UserIndex"].'</td>
                <td>'.$rows["AccountName"].'</td>
                <td>'.$rows["UserID"].'</td>
                <td>'.kuotaMB($rows["UserKBBank"]).'</td>
                <td>'.kuotaMB($totalin).'</td>
                <td>'.kuotaMB($totalout).'</td>
                <td>'.kuotaMB($total_kuota).'</td>
                
                <td>'.$rows["GroupName"].' ('.$bw.')</td>
                <td>edit</td>
            </tr>';
            
    //all user check
    if(($total_kuota > 1) AND ($total_kuota <= (2*1024*1024*1024)) ){
        
        if((strpos($rows["GroupName"], "bw.5")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi1."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi", "$query_bw");
        }
    }elseif(($total_kuota > (2*1024*1024*1024)) AND ($total_kuota <= (3*1024*1024*1024)) ){
        if((strpos($rows["GroupName"], "bw.4")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi2."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (3*1024*1024*1024)) AND ($total_kuota <= (4*1024*1024*1024)) ){
        if((strpos($rows["GroupName"], "bw.3")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi3."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (4*1024*1024*1024)) AND ($total_kuota <= (5*1024*1024*1024)) ){
        if((strpos($rows["GroupName"], "bw.2")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi4."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (5*1024*1024*1024)) AND ($total_kuota <= (6*1024*1024*1024)) ){
        if((strpos($rows["GroupName"], "bw.1")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi5."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (6*1024*1024*1024)) ){
        if((strpos($rows["GroupName"], "bw.1")) === FALSE){
            
            $query_bw = "UPDATE [dbo].[Users] SET [GroupName] = '".$kondisi5."' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }
    
    //UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi."  ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'
    
    //log insert to MSSQL server 95
    //enableLog("","dwi", "dwi","cek bw");
    
    $no++;

}


$content .='</tbody></table>
                                    </div>
                                </div><!-- /.box-body-->
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '<script type="text/javascript">
    $(function () {
        $.ajaxSetup({ cache: false }); 
        setInterval(function() {
            $(\'#cek_bw\').load(\''.URL.'config/admin/ajax/cek_bw_group.php\');
        }, 60000); 
    });
    
</script>';

    $title	= 'Cek Bandwidth';
    $submenu	= "inet_datausage";
    //$plugins	= '';
    $user	= "Admin";
    $group	= "customer";
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>