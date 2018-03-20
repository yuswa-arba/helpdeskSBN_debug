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
session_start();
ob_start();

//file configuration for database and create session.
include ("../../config/configuration_admin.php");

global $conn;


$conn_soft = Config::getInstanceSoft();

$sql_tbcustomer = $conn_soft->prepare("SELECT * FROM [4RBSSQL].[dbo].[tbCustomer];");

$sql_tbcustomer->execute();
//$row_billing_transaksi = $sql_billing_transaksi->fetch();
$row_tbcustomer = $sql_tbcustomer->fetchAll(PDO::FETCH_ASSOC);


foreach ($row_tbcustomer as $rows)
{
    //check on mysql database tbCustomer
    $mysql_tbcustomer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".mysql_real_escape_string(trim($rows["cKode"]))."' LIMIT 0,1;", $conn);
    $row_mysql_tbcustomer = mysql_fetch_array($mysql_tbcustomer);
    $total_mysql_tbcustomer =mysql_num_rows($mysql_tbcustomer);
    //echo $total_mysql_tbcustomer;
    if($total_mysql_tbcustomer == 0)
    {
        //insert to tbcustomer
        $insert = "INSERT INTO `tbCustomer` (`idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`,
	`cKota`, `cArea`, `cContact`, `ctelp`, `cfax`,
	`cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`,
	`cSales`, `nNext`, `cSubArea`, `cDaerah`,
	`nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`,
	`cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`,
	`cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`,
	`rowguid`, `cIncludePPN`, `cExcludePPN`,
	`cIncludePPH`, `cNamaKomisi`, `nKomisi`,
	`cUserFree`, `cKodeParent`, `cIP1`,
	`cIP2`, `cIP3`, `nterm`, `cMailIntern`,
	`cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`,
	`cCustomInfo4`, `cComments`, `dTglLahir`,
	`cMacAdd`, `cKdBTS`,
	`cNamaBTS`, `cNoRekVirtual`, `cStatus`,
	`cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`,
	`cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`,
	`cIpR4`, `cAccIndex`, `iuserIndex`,
	`cGroupRBS`, `cJenis`, `cBaru`,
	`dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`,
	`cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cNoKTP`,
	`cLongi`, `cLati`, `cBulanan`, `cTahunan`,
	`id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`,
	`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".mysql_real_escape_string(trim($rows["cKode"]))."', '".mysql_real_escape_string(trim($rows["cNama"]))."', '".mysql_real_escape_string(trim($rows["cAlamat1"]))."', '".mysql_real_escape_string(trim($rows["cAlamat2"]))."',
	'".mysql_real_escape_string(trim($rows["cKota"]))."', '".mysql_real_escape_string(trim($rows["cArea"]))."', '".mysql_real_escape_string(trim($rows["cContact"]))."', '".mysql_real_escape_string(trim($rows["ctelp"]))."', '".mysql_real_escape_string(trim($rows["cfax"]))."',
	'".mysql_real_escape_string(trim($rows["cKet"]))."', '".mysql_real_escape_string(trim($rows["nBatas"]))."', '".mysql_real_escape_string(trim($rows["cKodePl"]))."', '".mysql_real_escape_string(trim($rows["cNoAcc"]))."', '".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglDtgAkhir"]))))."', '".mysql_real_escape_string(trim($rows["nHrKunjung"]))."',
	'".mysql_real_escape_string(trim($rows["cSales"]))."', '".mysql_real_escape_string(trim($rows["nNext"]))."', '".mysql_real_escape_string(trim($rows["cSubArea"]))."', '".mysql_real_escape_string(trim($rows["cDaerah"]))."',
	'".mysql_real_escape_string(trim($rows["nNo"]))."', '".mysql_real_escape_string(trim($rows["cMasukJd"]))."', '".mysql_real_escape_string(trim($rows["cCab"]))."', '".mysql_real_escape_string(trim($rows["cIntern"]))."', '".mysql_real_escape_string(trim($rows["cNamaPers"]))."', '".mysql_real_escape_string(trim($rows["cEmail"]))."',
	'".mysql_real_escape_string(trim($rows["cUserID"]))."', '".mysql_real_escape_string(trim($rows["cPaket"]))."', '".mysql_real_escape_string(trim($rows["nHargaPaket"]))."', '".mysql_real_escape_string(trim($rows["cCustInternet"]))."',
	'".mysql_real_escape_string(trim($rows["cKdPaket"]))."', '".mysql_real_escape_string(trim($rows["cKdOT"]))."', '".mysql_real_escape_string(trim($rows["cNamaOT"]))."', '".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglMulai"]))))."', '".mysql_real_escape_string(trim($rows["dTglBerhenti"]))."','".mysql_real_escape_string(trim($rows["cNonAktiv"]))."',
	'".mysql_real_escape_string(trim($rows["rowguid"]))."', '".mysql_real_escape_string(trim($rows["cIncludePPN"]))."', '".mysql_real_escape_string(trim($rows["cExcludePPN"]))."',
	'".mysql_real_escape_string(trim($rows["cIncludePPH"]))."', '".mysql_real_escape_string(trim($rows["cNamaKomisi"]))."', '".mysql_real_escape_string(trim($rows["nKomisi"]))."',
	'".mysql_real_escape_string(trim($rows["cUserFree"]))."', '".mysql_real_escape_string(trim($rows["cKodeParent"]))."', '".mysql_real_escape_string(trim($rows["cIP1"]))."',
	'".mysql_real_escape_string(trim($rows["cIP2"]))."', '".mysql_real_escape_string(trim($rows["cIP3"]))."', '".mysql_real_escape_string(trim($rows["nterm"]))."', '".mysql_real_escape_string(trim($rows["cMailIntern"]))."',
	'".mysql_real_escape_string(trim($rows["cCustomInfo1"]))."', '".mysql_real_escape_string(trim($rows["cCustomInfo2"]))."', '".mysql_real_escape_string(trim($rows["cCustomInfo3"]))."',
	'".mysql_real_escape_string(trim($rows["cCustomInfo4"]))."', '".mysql_real_escape_string(trim($rows["cComments"]))."', '".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglLahir"]))))."',
	'".mysql_real_escape_string(trim($rows["cMacAdd"]))."', '".mysql_real_escape_string(trim($rows["cKdBTS"]))."',
	'".mysql_real_escape_string(trim($rows["cNamaBTS"]))."', '".mysql_real_escape_string(trim($rows["cNoRekVirtual"]))."', '".mysql_real_escape_string(trim($rows["cStatus"]))."',
	'".mysql_real_escape_string(trim($rows["cNamaIbu"]))."', '".mysql_real_escape_string(trim($rows["cNoHp1"]))."', '".mysql_real_escape_string(trim($rows["cNoHp2"]))."', '".mysql_real_escape_string(trim($rows["cNoHp3"]))."',
	'".mysql_real_escape_string(trim($rows["cBarcode"]))."', '".mysql_real_escape_string(trim($rows["cPassword"]))."', '".mysql_real_escape_string(trim($rows["cIpR1"]))."', '".mysql_real_escape_string(trim($rows["cIpR2"]))."', '".mysql_real_escape_string(trim($rows["cIpR3"]))."',
	'".mysql_real_escape_string(trim($rows["cIpR4"]))."', '".mysql_real_escape_string(trim($rows["cAccIndex"]))."', '".mysql_real_escape_string(trim($rows["iuserIndex"]))."',
	'".mysql_real_escape_string(trim($rows["cGroupRBS"]))."', '".mysql_real_escape_string(trim($rows["cJenis"]))."', '".mysql_real_escape_string(trim($rows["cBaru"]))."',
	'".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglTagihan"]))))."', '".mysql_real_escape_string(trim($rows["cKdNAS"]))."', '".mysql_real_escape_string(trim($rows["NASAttribute"]))."', '".mysql_real_escape_string(trim($rows["iGenerate"]))."', '".mysql_real_escape_string(trim($rows["cKonversi"]))."',
	'', '', '', '',
	'', '', '', '',
	'', '', '', '', '0', 'rbs',
	'system_auto', 'system_auto', NOW(), NOW(), '0');";
        //echo $insert."<br>";
	mysql_query($insert, $conn) or die ("errorinsert");
	//echo "ok insert;<br>";
        //'".mysql_real_escape_string(trim($rows["cKontrak"]))."', '".mysql_real_escape_string(trim($rows["cPPHPasal23"]))."', '".mysql_real_escape_string(trim($rows["cPPHPasal23Gx"]))."', '".mysql_real_escape_string(trim($rows["cNoKTP"]))."',
	//'".mysql_real_escape_string(trim($rows["cLongi"]))."', '".mysql_real_escape_string(trim($rows["cLati"]))."', '".mysql_real_escape_string(trim($rows["cBulanan"]))."', '".mysql_real_escape_string(trim($rows["cTahunan"]))."',
	
    }elseif($total_mysql_tbcustomer == 1)
    {
        //update to tbcustomer
        $update = "UPDATE `tbCustomer` SET `cNama` = '".mysql_real_escape_string(trim($rows["cNama"]))."', `cAlamat1`='".mysql_real_escape_string(trim($rows["cAlamat1"]))."',
	`cAlamat2`='".mysql_real_escape_string(trim($rows["cAlamat2"]))."', `cKota`='".mysql_real_escape_string(trim($rows["cKota"]))."', `cArea`='".mysql_real_escape_string(trim($rows["cArea"]))."',
	`cContact`='".mysql_real_escape_string(trim($rows["cContact"]))."', `ctelp`= '".mysql_real_escape_string(trim($rows["ctelp"]))."', `cfax`='".mysql_real_escape_string(trim($rows["cfax"]))."',
	`cKet`='".mysql_real_escape_string(trim($rows["cKet"]))."', `nBatas`='".mysql_real_escape_string(trim($rows["nBatas"]))."', `cKodePl`='".mysql_real_escape_string(trim($rows["cKodePl"]))."',
	`cNoAcc`='".mysql_real_escape_string(trim($rows["cNoAcc"]))."', `dTglDtgAkhir`='".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglDtgAkhir"]))))."', `nHrKunjung`='".mysql_real_escape_string(trim($rows["nHrKunjung"]))."',
	`cSales`='".mysql_real_escape_string(trim($rows["cSales"]))."', `nNext`='".mysql_real_escape_string(trim($rows["nNext"]))."', `cSubArea`='".mysql_real_escape_string(trim($rows["cSubArea"]))."',
	`cDaerah`='".mysql_real_escape_string(trim($rows["cDaerah"]))."', `nNo`='".mysql_real_escape_string(trim($rows["nNo"]))."', `cMasukJd`='".mysql_real_escape_string(trim($rows["cMasukJd"]))."',
	`cCab`='".mysql_real_escape_string(trim($rows["cCab"]))."', `cIntern`='".mysql_real_escape_string(trim($rows["cIntern"]))."', `cNamaPers`='".mysql_real_escape_string(trim($rows["cNamaPers"]))."',
	`cEmail`='".mysql_real_escape_string(trim($rows["cEmail"]))."', `cUserID`='".mysql_real_escape_string(trim($rows["cUserID"]))."', `cPaket`='".mysql_real_escape_string(trim($rows["cPaket"]))."',
	`nHargaPaket`='".mysql_real_escape_string(trim($rows["nHargaPaket"]))."', `cCustInternet`='".mysql_real_escape_string(trim($rows["cCustInternet"]))."', `cKdPaket`='".mysql_real_escape_string(trim($rows["cKdPaket"]))."',
	`cKdOT`='".mysql_real_escape_string(trim($rows["cKdOT"]))."', `cNamaOT`='".mysql_real_escape_string(trim($rows["cNamaOT"]))."', `dTglMulai`='".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglMulai"]))))."',
	`dTglBerhenti`='".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglBerhenti"]))))."', `cNonAktiv`='".mysql_real_escape_string(trim($rows["cNonAktiv"]))."', `rowguid`='".mysql_real_escape_string(trim($rows["rowguid"]))."',
	`cIncludePPN`='".mysql_real_escape_string(trim($rows["cIncludePPN"]))."', `cExcludePPN`='".mysql_real_escape_string(trim($rows["cExcludePPN"]))."', `cIncludePPH`='".mysql_real_escape_string(trim($rows["cIncludePPH"]))."',
	`cNamaKomisi`='".mysql_real_escape_string(trim($rows["cNamaKomisi"]))."', `nKomisi`='".mysql_real_escape_string(trim($rows["nKomisi"]))."', `cUserFree`='".mysql_real_escape_string(trim($rows["cUserFree"]))."',
	`cKodeParent`='".mysql_real_escape_string(trim($rows["cKodeParent"]))."', `cIP1`='".mysql_real_escape_string(trim($rows["cIP1"]))."', `cIP2`='".mysql_real_escape_string(trim($rows["cIP2"]))."',
	`cIP3`='".mysql_real_escape_string(trim($rows["cIP3"]))."', `nterm`='".mysql_real_escape_string(trim($rows["nterm"]))."', `cMailIntern`='".mysql_real_escape_string(trim($rows["cMailIntern"]))."',
	`cCustomInfo1`='".mysql_real_escape_string(trim($rows["cCustomInfo1"]))."', `cCustomInfo2`='".mysql_real_escape_string(trim($rows["cCustomInfo2"]))."',
	`cCustomInfo3`='".mysql_real_escape_string(trim($rows["cCustomInfo3"]))."', `cCustomInfo4`='".mysql_real_escape_string(trim($rows["cCustomInfo4"]))."', `cComments`='".mysql_real_escape_string(trim($rows["cComments"]))."',
	`dTglLahir`='".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglLahir"]))))."', `cMacAdd`='".mysql_real_escape_string(trim($rows["cMacAdd"]))."', `cKdBTS`='".mysql_real_escape_string(trim($rows["cKdBTS"]))."',
	`cNamaBTS`='".mysql_real_escape_string(trim($rows["cNamaBTS"]))."', `cNoRekVirtual`='".mysql_real_escape_string(trim($rows["cNoRekVirtual"]))."', `cStatus`='".mysql_real_escape_string(trim($rows["cStatus"]))."',
	`cNamaIbu`='".mysql_real_escape_string(trim($rows["cNamaIbu"]))."', `cNoHp1`='".mysql_real_escape_string(trim($rows["cNoHp1"]))."', `cNoHp2`='".mysql_real_escape_string(trim($rows["cNoHp2"]))."',
	`cNoHp3`='".mysql_real_escape_string(trim($rows["cNoHp3"]))."', `cBarcode`='".mysql_real_escape_string(trim($rows["cBarcode"]))."', `cPassword`='".mysql_real_escape_string(trim($rows["cPassword"]))."',
	`cIpR1`='".mysql_real_escape_string(trim($rows["cIpR1"]))."', `cIpR2`='".mysql_real_escape_string(trim($rows["cIpR2"]))."', `cIpR3`='".mysql_real_escape_string(trim($rows["cIpR3"]))."', `cIpR4`='".mysql_real_escape_string(trim($rows["cIpR4"]))."',
	`cAccIndex`='".mysql_real_escape_string(trim($rows["cAccIndex"]))."', `iuserIndex`='".mysql_real_escape_string(trim($rows["iuserIndex"]))."', `cGroupRBS`='".mysql_real_escape_string(trim($rows["cGroupRBS"]))."',
	`cJenis`='".mysql_real_escape_string(trim($rows["cJenis"]))."', `cBaru`='".mysql_real_escape_string(trim($rows["cBaru"]))."', `dTglTagihan`='".date("Y-m-d H:i:s", strtotime(mysql_real_escape_string(trim($rows["dTglTagihan"]))))."',
	`cKdNAS`='".mysql_real_escape_string(trim($rows["cKdNAS"]))."', `NASAttribute`='".mysql_real_escape_string(trim($rows["NASAttribute"]))."', `iGenerate`='".mysql_real_escape_string(trim($rows["iGenerate"]))."',
	`cKonversi`='".mysql_real_escape_string(trim($rows["cKonversi"]))."',
	`gx_tipe`= 'rbs', `user_upd`='system_auto', `date_upd`= NOW(), `level`='0'
	WHERE (`cKode`= '".mysql_real_escape_string(trim($rows["cKode"]))."');";

	//echo $update."<br>";
	mysql_query($update, $conn) or die ("errorupdate");
	//echo "ok update;<br>";
	
    }
    
}