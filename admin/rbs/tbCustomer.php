<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/payment
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi
 * Desc: 
 * 
 */
include ("../../config/configuration_admin.php");
/*session_start();
ob_start();

//file configuration for database and create session.

//redirectToHTTPS();

if (!login_check())  
  { 
    echo "<script language=javascript>
            alert('Your Session Expired.');
            window.location.href='logout.php';
          </script>"; 
    exit(0); 
  } 
  else  
  {
    
    if($loggedin = logged_in()){ // Check if they are logged in 
      if($loggedin["group"] == "member"){
 */       

  //the SQL statement that will query the database
   $conn_soft = Config::getInstanceSoft();

    $sql_data = $conn_soft->prepare("select top 100 dbo.Users.AccountIndex, dbo.Users.UserID, dbo.AccountTypes.AccountName, dbo.Users.UserActive, dbo.Users.GroupName
  FROM dbo.Users, dbo.AccountTypes where dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
  AND dbo.Users.UserID LIKE '%purw%';");
	
	$sql_data->execute();
/*$query = "SELECT TOP 10 [tbPiutang].* from  [tbPiutang], [tbJual]
			  WHERE [tbPiutang].[nDebet] = [tbPiutang].[nBayar]
                          AND [tbPiutang].[cNoJual] = [tbJual].[cNoJual]
                          AND [tbPiutang].[nKredit] != '0.00'
			  
			  ORDER BY [tbPiutang].[dTanggal] DESC
			  ;";
$query1 = "SELECT [tbJual].* from [tbJual], [tbCustomer]
			  WHERE [tbJual].[cKode]=[tbCustomer].[cKode]
			  AND [tbJual].[cKode]= '".$loggedin["cust_number"]."'
                          AND [tbJual].[cNoJual] = 'BJL-130201995'
			  ORDER BY [tbJual].[dtanggal] DESC;";
/*  $query = "SELECT TOP 100 *
FROM tbCustomer
WHERE cKode NOT IN (
    SELECT TOP 0 cKode
    FROM tbCustomer
    ORDER BY cKode
);";
  $query = "SELECT [tbJual].* from [tbJual], [tbJualDtl], [tbCustomer]
  WHERE [tbJual].[cKode]=[tbCustomer].[cKode]
  AND [tbJual].[cNoJual]=[tbJualDtl].[cNoJual]
  AND [tbCustomer].[cKode] = 'GNB-A0003';";
*/
  //perform the query
  
  echo '<table class="table" border="1" id="sess_history">
                                        <thead>
                                        <tr>
											<th><b>No</b></th>
                                            <th><b>AccountType</b></th>
											<th><b>GroupName</b></th>
                                            <th><b>UserID</b></th>
                                            <th><b>AccountName</b></th>
											<th><b>Status</b></th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>';

  //fetch tha data from the database
$no =1;
    while ($row_data = $sql_data->fetch())
	{
    echo '<tr>
				<td>'.$no.'</td>
                <td>'.$row_data["AccountIndex"].'</td>
                <td>'.$row_data["GroupName"].'</td>
				<td>'.$row_data["UserID"].'</td>
                <td>'.$row_data["AccountName"].'</td>
				<td>'.(($row_data["UserActive"] == "0") ? "Aktif" : "NonAktif") .'</td>
            </tr>';
            $no++;
}
 
  echo "</table >";


/*}else{
        header("location: logout.php");
      }
    }else{
        header("location: logout.php");
    }
  
  
  
    }

?>*/