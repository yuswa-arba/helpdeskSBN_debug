<?php
// Include the main TCPDF library (search for installation path).
include ("../../../config/configuration_admin.php");
redirectToHTTPS();
if($loggedin = logged_inStaff())
{ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
    if($loggedin["group"] == 'staff')
    {
        if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
        enableLog("", $loggedin["username"], $loggedin["username"], "proposal");
        global $conn;
    
        $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
	

        $query_data1	= "SELECT * FROM `gx_proposal` WHERE `id_proposal`='$id_data' AND `level` = '0' LIMIT 0,1;";
        $sql_data1		= mysql_query($query_data1, $conn);
        $row_data1		= mysql_fetch_array($sql_data1);
        $nama_marketing= $loggedin["username"];
        $date = date("d F Y");
        
        print_r(explode(' ',$row_data1['nama_perusahaan']));
        $str = $row_data1["pdf_content"];
        $lines_arr = explode('</p>', $str);
        $num_newlines = count($lines_arr) -1;
        
        $page_one = '';
        $page_two = '';
        
        echo $num_newlines;
        echo "<pre>";
        print_r($lines_arr);
        echo "</pre>";
        if($num_newlines <= '21')
        {
            
            foreach($lines_arr as $lines)
            {
                $page_one .= $lines.'</p>';
            }
        }
        elseif($num_newlines > '21' OR $num_newlines <= '80')
        {
           
            for($i=0;$i<=21;$i++)
            {
                $page_one .= $i.$lines_arr[$i].'</p>';
            }
            
            for($i=22;$i<=$num_newlines;$i++)
            {
                $page_two .= $i.$lines_arr[$i].'</p>';
            }
        }
        
        
$page_satu = <<<EOF
$page_one
EOF;

$page_dua = <<<EOF
$page_two
EOF;
echo "Line1<>";
print_r($page_satu);
echo "</>";
echo "Line2 <>";
print_r($page_dua);
echo "</>";

}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>