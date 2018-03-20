<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){

     global $conn;
     $conn_soft = Config::getInstanceSoft();
     
     $tipe	= isset($_GET['tipe']) ? mysql_real_escape_string(strip_tags(trim($_GET['tipe']))) : "";
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Select $tipe");
     

     if($tipe == "account_index")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select = $conn_soft ->prepare("SELECT [AccountIndex], [AccountName], [AccountDescription]
						  FROM [dbo].[AccountTypes]
						  WHERE [AccountName] LIKE '%".$nama."%';");
	       $sql_select->execute();
	  }else
	  {
	       $sql_select = $conn_soft ->prepare("SELECT [AccountIndex], [AccountName], [AccountDescription]
						  FROM [dbo].[AccountTypes];");
	       $sql_select->execute();
	  }
	  
       
     }elseif($tipe == "group_name")
     {
	  if(isset($_POST["save_search"]))
	  {
               $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
               
	       $sql_select = $conn_soft ->prepare("SELECT [GroupIndex], [GroupName], [NASAttributes],
					     [AccountIndex], [TimeBank], [KBBank], [Active]
					     FROM [dbo].[Groups]
					     WHERE [GroupName] LIKE '%".$nama."%';");
	       $sql_select->execute();
	  }else
	  {
	       $sql_select = $conn_soft ->prepare("SELECT [GroupIndex], [GroupName], [NASAttributes],
					     [AccountIndex], [TimeBank], [KBBank], [Active]
					     FROM [dbo].[Groups];");
	       $sql_select->execute();
	  }
	  
     }
     
     $content ='<section class="content-header">
		     <h1>
			 Data '.$tipe.'
		     </h1>
		     
		 </section>
 
		 <!-- Main content -->
		 <section class="content">
		     <div class="row">
			 <div class="col-xs-12">
			     <div class="box">
				   <div class="box-header">
					<h2 class="box-title">Data '.$tipe.'</h2>
				   </div>
				 
				   <div class="box-body">
					<form action="" method="post" name="form_search" id="form_search">
					     <table class="form" >
						  <tr>
						       <td><label>Name</label></td>
						       <td><input class="form-control" name="nama_staff" placeholder="Name" type="text" value=""></td>
						       
						  </tr>
						  <tr>
						       <td>&nbsp;</td>
						       <td><input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search"></td>
						  </tr>
					     </table>
					</form>';
if($tipe == "account_index")
{
     $content .='<table class="table table-bordered table-striped" id="tech">
	       <thead>
		 <tr>
		   <th>#</th>
		   <th>AccountIndex</th>
		   <th>Account Name</th>
		   <th>Account Description</th>
		   <th>Action</th>
		 </tr>
	       </thead>
	       <tbody>';
     $no = 1;

     while ($row_select = $sql_select->fetch(PDO::FETCH_ASSOC))
     {
	  $content .='<tr>
	       <td>'.$no.'.</td>
	       <td>'.$row_select["AccountIndex"].'</td>
	       <td>'.$row_select["AccountName"].'</td>
	       <td>'.$row_select["AccountDescription"].'</td>
	       <td><a href="" onclick="selectdata(\''.$row_select["AccountIndex"].'\',\''.$row_select["AccountName"].'\')">Select</a></td>
	       </tr>';
	  $no++;
     }
     
     $content .='
                        </tbody>
                      </table>';
                      
}elseif($tipe == "group_name")
{
     $content .='<table class="table table-bordered table-striped" id="tech">
               <thead>
		    <tr>
			 <th>#</th>
			 <th>GroupIndex</th>
			 <th>GroupName</th>
			 <th>NASAttributes</th>
			 
			 <th>TimeBank</th>
			 <th>KBBank</th>
			 <th>Action</th>
                    </tr>
               </thead>
               <tbody>';
     $no = 1;
     while ($row_select = $sql_select->fetch(PDO::FETCH_ASSOC))
     {
	  $content .='<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_select["GroupIndex"].'</td>
		    <td>'.$row_select["GroupName"].'</td>
		    <td>'.$row_select["NASAttributes"].'</td>
		    <td>'.$row_select["TimeBank"].'</td>
		    <td>'.$row_select["KBBank"].'</td>
		    <td><a href="" onclick="selectdata(\''.$row_select["GroupIndex"].'\',\''.$row_select["GroupName"].'\')">Select</a></td>
		    </tr>';
	  $no++;
     }
     $content .='
                        </tbody>
                      </table>';
     
}
		$content .='</div>
			      </div>
			      
			 </div>
		     </div>
 
		 </section><!-- /.content -->
	     ';

$plugins = '
	
<script type="text/javascript">';

if($tipe == "account_index")
{
     $plugins .='function selectdata(uid,  nama){
                window.opener.document.form_paket.account_index.value=uid;
                window.opener.document.form_paket.account_name.value=nama;
		self.close();
		}';
}elseif($tipe == "group_name")
{
     $plugins .='function selectdata(uid,  nama){
                window.opener.document.form_paket.group_index.value=uid;
                window.opener.document.form_paket.group_name.value=nama;
		self.close();
		}
		';
}

$plugins .='
</script>

<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#tech\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
		    
	    });
	    
	   
        </script>

    ';

    $title	= 'Select ';
    $submenu	= "mailbox";
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