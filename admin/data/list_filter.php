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
    
    global $conn;
    if(isset($_POST["hapus"]))
    {
        $id_filter = array();
        $id_filter = isset($_POST["id_filter"]) ? $_POST["id_filter"] : $id_filter;
        
        foreach($id_filter as $key => $value)
        {
			if($value != "")
			{
				$sql_update = mysql_query("UPDATE `gx_inet_filter` SET `level` = '1', `date_upd` = NOW() WHERE `id_filter` = '".$value."';", $conn) or die (mysql_error());
			}
		}
        header("location:list_filter.php");
    }
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Filter Bandwidth Internet</h3>
                                    <div class="box-tools pull-right">
                                        
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <div>
                                        <a href="'.URL_ADMIN.'data/form_filter">New Filter</a>
                                    </div><br>
                                
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                
                                                <th>Tipe</th>
                                                <th>Keterangan</th>
                                                
						<th>Action</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["value"]) ? trim(strip_tags($_POST["value"])) : "";
    
    $sql_search		= ($search != "") ? "AND `value` LIKE '%$search%'" : "";
    
    
    $sql_data = mysql_query("SELECT * FROM `gx_inet_filter`
				  WHERE `level` = '0'
                                  $sql_search
				  ORDER BY `id_filter` ASC LIMIT 0,10;", $conn);
}else{
    $sql_data = mysql_query("SELECT * FROM `gx_inet_filter`
				  WHERE `level` = '0' ORDER BY `id_filter` ASC;", $conn);
}

$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.StatusFilter($row_data["tipe_filter"]).'</td>
		    <td>'.$row_data["value"].'</td>
		    <td align="center"><a href="detail_filter?id='.$row_data["id_filter"].'">Detail</a> | 
                    <a href="form_filter?id='.$row_data["id_filter"].'">Update</a></td>
                    <td><input type="checkbox" name="id_filter[]" value="'.$row_data["id_filter"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List Filter Internet';
    $submenu	= "inet_filter";
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