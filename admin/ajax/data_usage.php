<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration.php");

redirectToHTTPS();

global $conn_voip;

$content ='<table class="table table-hover table-border">
                                        <thead>
                                        <tr>
                                            <th><b>No</b></th>
                                            <th><b>UserIndex</b></th>
                                            <th><b>UserID</b></th>
                                            <th><b>Sisa Kuota</b></th>
                                            <th><b>Session In</b></th>
                                            <th><b>Session Out</b></th>
                                            <th><b>Total</b></th>
                                            <th><b>Bandwidth</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                ';
//enableLog("","dwi", "dwi","cek bw");

$no = 1;
$conn_soft = Config::getInstanceSoft();


$sql_all_user = $conn_soft ->prepare("SELECT  * FROM [dbo].[Users] WHERE [userActive] = '1';");
$sql_all_user->execute();

$kondisi1 = '$bwrate=5M/5M     ';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
$kondisi2 = '$bwrate=4M/4M     ';
$kondisi3 = '$bwrate=3M/3M     ';
$kondisi4 = '$bwrate=2M/2M     ';
$kondisi5 = '$bwrate=1M/1M     ';

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

$row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);

foreach($row_total_data as $kuota){
    $totalin = $totalin + ($kuota["totalin"]);
    $totalout = $totalout + ($kuota["totalout"]);
    $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
    
}

    
    if((strpos($rows["NASAttributes"], "5M")) !== FALSE){
        $bw = "5Mbps";
    }elseif((strpos($rows["NASAttributes"], "4M")) !== FALSE){
        $bw = "4Mbps";
    }elseif((strpos($rows["NASAttributes"], "3M")) !== FALSE){
        $bw = "3Mbps";
    }elseif((strpos($rows["NASAttributes"], "2M")) !== FALSE){
        $bw = "2Mbps";
    }elseif((strpos($rows["NASAttributes"], "1M")) !== FALSE){
        $bw = "1Mbps";
    }
    
    $max_kuota = kuotaKB($rows["UserKBBank"]);
    
    $content .='<tr>
                <td>'.$no.'.</td>
                <td>'.$rows["UserIndex"].'</td>
                <td>'.$rows["UserID"].'</td>
                <td>'.kuotaMB($rows["UserKBBank"]).'</td>
                <td>'.kuotaMB($totalin).'</td>
                <td>'.kuotaMB($totalout).'</td>
                <td>'.kuotaMB($total_kuota).'</td>
                <td>'.$bw.'</td>
            </tr>';
    
    if(($total_kuota > 1) AND ($total_kuota <= (2*1024*1024*1024)) ){
        
        if((strpos($rows["NASAttributes"], "5M")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi1."    ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi", "$query_bw");
        }
    }elseif(($total_kuota > (2*1024*1024*1024)) AND ($total_kuota <= (3*1024*1024*1024)) ){
        if((strpos($rows["NASAttributes"], "4M")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi2."    ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (3*1024*1024*1024)) AND ($total_kuota <= (4*1024*1024*1024)) ){
        if((strpos($rows["NASAttributes"], "3M")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi3."    ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (4*1024*1024*1024)) AND ($total_kuota <= (5*1024*1024*1024)) ){
        if((strpos($rows["NASAttributes"], "2M")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi4."    ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (5*1024*1024*1024)) AND ($total_kuota <= (6*1024*1024*1024)) ){
        if((strpos($rows["NASAttributes"], "1M")) === FALSE){
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi5."     ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();
            //echo $query_bw;
            enableLog("","dwi", "dwi",$query_bw);
        }
    }elseif(($total_kuota > (6*1024*1024*1024)) ){
        if((strpos($rows["NASAttributes"], "1M")) === FALSE){
            
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '".$kondisi5."     ' WHERE [Users].[UserIndex] = '".$rows["UserIndex"]."'";
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


$content .='</tbody></table>';

echo $content;