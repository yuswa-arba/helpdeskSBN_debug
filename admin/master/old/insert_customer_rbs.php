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
include ("function/configuration.php");

#one line
//$conn = odbc_connect("DRIVER=SQL Server;SERVER=".$ser.";UID=".$user.";PWD=".$pass.";DATABASE=".$db.";Address=".$ser.",1433","","");

/*if ( !$conn ){
    echo "Couldnot connect to database";
}
*/
    /*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    header("Content-disposition: attachment; filename=insertCustomer.txt");
    header("Content-type: text/plain");*/
    
ini_set('memory_limit', '128M');
global $conn_sql;


//insert sql server tbcustomer
INSERT INTO ..
([cKode], [cNama], [cAlamat1], [cAlamat2], [cKota], [cArea], [cContact], [ctelp], [cfax], [cKet], [nBatas], [cKodePl],
 [cNoAcc], [dTglDtgAkhir], [nHrKunjung], [cSales], [nNext], [cSubArea], [cDaerah], [nNo], [cMasukJd], [cCab], [cIntern], [cNamaPers],
 [cEmail], [cUserID], [cPaket], [nHargaPaket], [cCustInternet], [cKdPaket], [cKdOT], [cNamaOT], [dTglMulai], [dTglBerhenti], [cNonAktiv],
 [rowguid], [cIncludePPN], [cExcludePPN], [cIncludePPH], [cNamaKomisi], [nKomisi], [cUserFree], [cKodeParent], [cIP1], [cIP2], [cIP3],
 [nterm], [cMailIntern], [cCustomInfo1], [cCustomInfo2], [cCustomInfo3], [cCustomInfo4], [cComments], [dTglLahir], [cMacAdd], [cKdBTS],
 [cNamaBTS], [cNoRekVirtual], [cStatus], [cNamaIbu], [cNoHp1], [cNoHp2], [cNoHp3], [cBarcode], [cPassword], [cIpR1], [cIpR2], [cIpR3],
 [cIpR4], [cAccIndex], [iuserIndex], [cGroupRBS], [cJenis], [cBaru], [dTglTagihan], [cKdNAS], [NASAttribute], [iGenerate], [cKonversi])
VALUES ('GNB-I0300 ', 'IDA AYU ANOM SRI SURYANI', 'JL. BAJANGSARI GG. 9, SANUR', '', 'DENPASAR', '', '', '03619002936 ; 03617804660', '',
	'', '.00', '   ', '113131    ', '2012-06-02 10:43:08.310', '0', '     ', '0', '          ', '                    ', '0', '0', 'B',
	'0', '                                                  ', 'dayu@simpleprod.com
	', 'rosaleone                                                                                           ', 'dl.upto.4.768
	', '.00', '0', 'dl.upto.4.768       ', '                    ', '                                        ',
	'2012-06-02 00:00:00.000', '2099-12-31 00:00:00.000', '0', '0810FEF6-AC90-4C0F-A443-E0D6BA46CDA0', '0', '0', '0', '
	', '.00', '0', '          ', '', '', '', '4.00', '', '', 'GNB-I0300', '', '', '', '1978-04-28 00:00:00.000', '',
	'          ', '', '9018868431          ', '0', 'IDA AYU PUTU ARIANI', '03619002936', '03617804660', '', '', '03202426',
	'0', '0', '0', '0', '112', '3313', 'vb-unlimited', '1', '1', '2099-01-01 00:00:00.000', '          ', '', '0', '0');


UPDATE TOP(1) .. SET
[cKode]='GNB-I0300 ', [cNama]='IDA AYU ANOM SRI SURYANI',
[cAlamat1]='JL. BAJANGSARI GG. 9, SANUR', [cAlamat2]='',
[cKota]='DENPASAR', [cArea]='', [cContact]='', [ctelp]='03619002936 ; 03617804660',
[cfax]='', [cKet]='', [nBatas]='.00', [cKodePl]='   ', [cNoAcc]='113131    ',
[dTglDtgAkhir]='2012-06-02 10:43:08.310', [nHrKunjung]='0', [cSales]='     ',
[nNext]='0', [cSubArea]='          ', [cDaerah]='                    ', [nNo]='0',
[cMasukJd]='0', [cCab]='B', [cIntern]='0', [cNamaPers]='                                                  ',
[cEmail]='dayu@simpleprod.com
', [cUserID]='rosaleone
', [cPaket]='dl.upto.4.768                           ', [nHargaPaket]='.00',
[cCustInternet]='0', [cKdPaket]='dl.upto.4.768       ', [cKdOT]='                    ',
[cNamaOT]='                                        ', [dTglMulai]='2012-06-02 00:00:00.000',
[dTglBerhenti]='2099-12-31 00:00:00.000', [cNonAktiv]='0', [rowguid]='0810FEF6-AC90-4C0F-A443-E0D6BA46CDA0',
[cIncludePPN]='0', [cExcludePPN]='0', [cIncludePPH]='0', [cNamaKomisi]='                              ',
[nKomisi]='.00', [cUserFree]='0', [cKodeParent]='          ', [cIP1]='', [cIP2]='', [cIP3]='',
[nterm]='4.00', [cMailIntern]='', [cCustomInfo1]='', [cCustomInfo2]='GNB-I0300', [cCustomInfo3]='',
[cCustomInfo4]='', [cComments]='', [dTglLahir]='1978-04-28 00:00:00.000', [cMacAdd]='', [cKdBTS]='          ',
[cNamaBTS]='', [cNoRekVirtual]='9018868431          ', [cStatus]='0', [cNamaIbu]='IDA AYU PUTU ARIANI',
[cNoHp1]='03619002936', [cNoHp2]='03617804660', [cNoHp3]='', [cBarcode]='', [cPassword]='03202426',
[cIpR1]='0', [cIpR2]='0', [cIpR3]='0', [cIpR4]='0', [cAccIndex]='112', [iuserIndex]='3313',
[cGroupRBS]='vb-unlimited', [cJenis]='1', [cBaru]='1', [dTglTagihan]='2099-01-01 00:00:00.000',
[cKdNAS]='          ', [NASAttribute]='', [iGenerate]='0', [cKonversi]='0' WHERE
([cKode]='GNB-I0300 ') AND ([cNama]='IDA AYU ANOM SRI SURYANI') AND ([cAlamat1]='JL. BAJANGSARI GG. 9, SANUR') AND
([cAlamat2]='') AND ([cKota]='DENPASAR') AND ([cArea]='') AND ([cContact]='') AND ([ctelp]='03619002936 ; 03617804660')
AND ([cfax]='') AND ([cKet]='') AND ([nBatas]='.00') AND ([cKodePl]='   ') AND ([cNoAcc]='113131    ') AND
([dTglDtgAkhir]='2012-06-02 10:43:08.310') AND ([nHrKunjung]='0') AND ([cSales]='     ') AND ([nNext]='0') AND
([cSubArea]='          ') AND ([cDaerah]='                    ') AND ([nNo]='0') AND ([cMasukJd]='0') AND
([cCab]='B') AND ([cIntern]='0') AND ([cNamaPers]='                                                  ') AND
([cEmail]='dayu@simpleprod.com                                                                                                                                                                                     ') AND ([cUserID]='rosaleone                                                                                           ') AND ([cPaket]='dl.upto.4.768                           ') AND ([nHargaPaket]='.00') AND ([cCustInternet]='0') AND ([cKdPaket]='dl.upto.4.768       ') AND ([cKdOT]='                    ') AND ([cNamaOT]='                                        ') AND ([dTglMulai]='2012-06-02 00:00:00.000') AND ([dTglBerhenti]='2099-12-31 00:00:00.000') AND ([cNonAktiv]='0') AND ([rowguid]='0810FEF6-AC90-4C0F-A443-E0D6BA46CDA0') AND ([cIncludePPN]='0') AND ([cExcludePPN]='0') AND ([cIncludePPH]='0') AND ([cNamaKomisi]='                              ') AND ([nKomisi]='.00') AND ([cUserFree]='0') AND ([cKodeParent]='          ') AND ([cIP1]='') AND ([cIP2]='') AND ([cIP3]='') AND ([nterm]='4.00') AND ([cMailIntern]='') AND ([cCustomInfo1]='') AND ([cCustomInfo2]='GNB-I0300') AND ([cCustomInfo3]='') AND ([cCustomInfo4]='') AND ([cComments]='') AND ([dTglLahir]='1978-04-28 00:00:00.000') AND ([cMacAdd]='') AND ([cKdBTS]='          ') AND ([cNamaBTS]='') AND ([cNoRekVirtual]='9018868431          ') AND ([cStatus]='0') AND ([cNamaIbu]='IDA AYU PUTU ARIANI') AND ([cNoHp1]='03619002936') AND ([cNoHp2]='03617804660') AND ([cNoHp3]='') AND ([cBarcode]='') AND ([cPassword]='03202426') AND ([cIpR1]='0') AND ([cIpR2]='0') AND ([cIpR3]='0') AND ([cIpR4]='0') AND ([cAccIndex]='112') AND ([iuserIndex]='3313') AND ([cGroupRBS]='vb-unlimited') AND ([cJenis]='1') AND ([cBaru]='1') AND ([dTglTagihan]='2099-01-01 00:00:00.000') AND ([cKdNAS]='          ') AND ([NASAttribute]='') AND ([iGenerate]='0') AND ([cKonversi]='0');



//SELECT TOP 10 * FROM (SELECT TOP 20 FROM Table ORDER BY Id) ORDER BY Id DESC
$query = "SELECT * FROM [tbCustomer] ORDER BY [cKode] ASC";
$sql_customer = odbc_exec($conn_sql, $query);
/*$content ='CREATE TABLE IF NOT EXISTS `tbCustomer` (
  `idCustomer` int(10) NOT NULL AUTO_INCREMENT,
  `cNama` varchar(50) NOT NULL,
  `cKode` varchar(50) NOT NULL,
  `cNama` varchar(50) NOT NULL,
  `cAlamat1` varchar(50) NOT NULL,
  `cAlamat2` varchar(50) NOT NULL,
  `cKota` varchar(50) NOT NULL,
  `cArea` varchar(50) NOT NULL,
  `cContact` varchar(50) NOT NULL,
  `ctelp` varchar(50) NOT NULL,
  `cfax` varchar(50) NOT NULL,
  `cKet` varchar(50) NOT NULL,
  `nBatas` varchar(50) NOT NULL,
  `cKodePl` varchar(50) NOT NULL,
  `cNoAcc` varchar(50) NOT NULL,
  `dTglDtgAkhir` varchar(50) NOT NULL,
  `nHrKunjung` varchar(50) NOT NULL,
  `cSales` varchar(50) NOT NULL,
  `nNext` varchar(50) NOT NULL,
  `cSubArea` varchar(50) NOT NULL,
  `cDaerah` varchar(50) NOT NULL,
  `nNo` varchar(50) NOT NULL,
  `cMasukJd` varchar(50) NOT NULL,
  `cCab` varchar(50) NOT NULL,
  `cIntern` varchar(50) NOT NULL,
  `cNamaPers` varchar(50) NOT NULL,
  `cEmail` varchar(200) NOT NULL,
  `cUserID` varchar(50) NOT NULL,
  `cPaket` varchar(50) NOT NULL,
  `nHargaPaket` varchar(50) NOT NULL,
  `cCustInternet` varchar(50) NOT NULL,
  `cKdPaket` varchar(50) NOT NULL,
  `cKdOT` varchar(50) NOT NULL,
  `cNamaOT` varchar(50) NOT NULL,
  `dTglMulai` varchar(50) NOT NULL,
  `dTglBerhenti` varchar(50) NOT NULL,
  `cNonAktiv` varchar(50) NOT NULL,
  `rowguid` varchar(50) NOT NULL,
  `cIncludePPN` varchar(50) NOT NULL,
  `cExcludePPN` varchar(50) NOT NULL,
  `cIncludePPH` varchar(50) NOT NULL,
  `cNamaKomisi` varchar(50) NOT NULL,
  `nKomisi` varchar(50) NOT NULL,
  `cUserFree` varchar(50) NOT NULL,
  `cKodeParent` varchar(50) NOT NULL,
  `cIP1` varchar(50) NOT NULL,
  `cIP2` varchar(50) NOT NULL,
  `cIP3` varchar(50) NOT NULL,
  `nterm` varchar(50) NOT NULL,
  `cMailIntern` varchar(50) NOT NULL,
  `cCustomInfo1` varchar(50) NOT NULL,
  `cCustomInfo2` varchar(50) NOT NULL,
  `cCustomInfo3` varchar(50) NOT NULL,
  `cCustomInfo4` varchar(50) NOT NULL,
  `cComments` varchar(50) NOT NULL,
  `dTglLahir` varchar(50) NOT NULL,
  `cMacAdd` varchar(50) NOT NULL,
  `cKdBTS` varchar(50) NOT NULL,
  `cNamaBTS` varchar(50) NOT NULL,
  `cNoRekVirtual` varchar(50) NOT NULL,
  `cStatus` varchar(50) NOT NULL,
  `cNamaIbu` varchar(50) NOT NULL,
  `cNoHp1` varchar(50) NOT NULL,
  `cNoHp2` varchar(50) NOT NULL,
  `cNoHp3` varchar(50) NOT NULL,
  `cBarcode` varchar(50) NOT NULL,
  `cPassword` varchar(50) NOT NULL,
  `cIpR1` varchar(50) NOT NULL,
  `cIpR2` varchar(50) NOT NULL,
  `cIpR3` varchar(50) NOT NULL,
  `cIpR4` varchar(50) NOT NULL,
  `cAccIndex` varchar(50) NOT NULL,
  `iuserIndex` varchar(50) NOT NULL,
  `cGroupRBS` varchar(50) NOT NULL,
  `cJenis` varchar(50) NOT NULL,
  `cBaru` varchar(50) NOT NULL,
  `dTglTagihan` varchar(50) NOT NULL,
  `cKdNAS` varchar(50) NOT NULL,
  `NASAttribute` varchar(50) NOT NULL,
  `iGenerate` varchar(50) NOT NULL,
  `cKonversi` varchar(50) NOT NULL,
  `cKontrak` varchar(50) NOT NULL,
  `cPPHPasal23` varchar(50) NOT NULL,
  `cPPHPasal23Gx` varchar(50) NOT NULL,
  PRIMARY KEY (`idCustomer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
'<table border="1">
<tr>
    <td>No.<td>
    <td>Kode Customer</td>
    <td>Nama<td>
    <td>Alamat<td>
    <td>Kota<td>
</tr>
    ';*/
    $content .="INSERT INTO `globalxt_payment`.`tbCustomer` (`idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`,
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
	`dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`,
	`cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cNoKTP`, `cLongi`, `cLati`,
        `cBulanan`, `cTahunan`, `date_add`, `date_upd`, `level`)

	VALUES";

    while( $row_data = odbc_fetch_array($sql_customer)){

	/*$i=0;
	for ($i=251;$i<=500;$i++){
	$row_data = odbc_fetch_array($sql_customer);
	*/

	/*echo "INSERT INTO `globalxt_payment`.`tbCustomer` (`idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`, `cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`, `cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`, `cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`, `cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`, `cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`)
	 VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');<br><br>";
	*/

	$content .=" (NULL, '".trim($row_data["cKode"])."', '".trim($row_data["cNama"])."', '".trim($row_data["cAlamat1"])."', '".trim($row_data["cAlamat2"])."',
	'".trim($row_data["cKota"])."', '".trim($row_data["cArea"])."', '".trim($row_data["cContact"])."', '".trim($row_data["ctelp"])."', '".trim($row_data["cfax"])."',
	'".trim($row_data["cKet"])."', '".trim($row_data["nBatas"])."', '".trim($row_data["cKodePl"])."', '".trim($row_data["cNoAcc"])."', '".trim($row_data["dTglDtgAkhir"])."', '".trim($row_data["nHrKunjung"])."',
	'".trim($row_data["cSales"])."', '".trim($row_data["nNext"])."', '".trim($row_data["cSubArea"])."', '".trim($row_data["cDaerah"])."',
	'".trim($row_data["nNo"])."', '".trim($row_data["cMasukJd"])."', '".trim($row_data["cCab"])."', '".trim($row_data["cIntern"])."', '".trim($row_data["cNamaPers"])."', '".trim($row_data["cEmail"])."',
	'".trim($row_data["cUserID"])."', '".trim($row_data["cPaket"])."', '".trim($row_data["nHargaPaket"])."', '".trim($row_data["cCustInternet"])."',
	'".trim($row_data["cKdPaket"])."', '".trim($row_data["cKdOT"])."', '".trim($row_data["cNamaOT"])."', '".trim($row_data["dTglMulai"])."', '".trim($row_data["dTglBerhenti"])."','".trim($row_data["cNonAktiv"])."',
	'".trim($row_data["rowguid"])."', '".trim($row_data["cIncludePPN"])."', '".trim($row_data["cExcludePPN"])."',
	'".trim($row_data["cIncludePPH"])."', '".trim($row_data["cNamaKomisi"])."', '".trim($row_data["nKomisi"])."',
	'".trim($row_data["cUserFree"])."', '".trim($row_data["cKodeParent"])."', '".trim($row_data["cIP1"])."',
	'".trim($row_data["cIP2"])."', '".trim($row_data["cIP3"])."', '".trim($row_data["nterm"])."', '".trim($row_data["cMailIntern"])."',
	'".trim($row_data["cCustomInfo1"])."', '".trim($row_data["cCustomInfo2"])."', '".trim($row_data["cCustomInfo3"])."',
	'".trim($row_data["cCustomInfo4"])."', '".trim($row_data["cComments"])."', '".trim($row_data["dTglLahir"])."',
	'".trim($row_data["cMacAdd"])."', '".trim($row_data["cKdBTS"])."',
	'".trim($row_data["cNamaBTS"])."', '".trim($row_data["cNoRekVirtual"])."', '".trim($row_data["cStatus"])."',
	'".trim($row_data["cNamaIbu"])."', '".trim($row_data["cNoHp1"])."', '".trim($row_data["cNoHp2"])."', '".trim($row_data["cNoHp3"])."',
	'".trim($row_data["cBarcode"])."', '".trim($row_data["cPassword"])."', '".trim($row_data["cIpR1"])."', '".trim($row_data["cIpR2"])."', '".trim($row_data["cIpR3"])."',
	'".trim($row_data["cIpR4"])."', '".trim($row_data["cAccIndex"])."', '".trim($row_data["iuserIndex"])."',
	'".trim($row_data["cGroupRBS"])."', '".trim($row_data["cJenis"])."', '".trim($row_data["cBaru"])."',
	'".trim($row_data["dTglTagihan"])."', '".trim($row_data["cKdNAS"])."', '".trim($row_data["NASAttribute"])."', '".trim($row_data["iGenerate"])."',
	'".trim($row_data["cKonversi"])."', '".trim($row_data["cKontrak"])."', '".trim($row_data["cPPHPasal23"])."', '".trim($row_data["cPPHPasal23Gx"])."',
        '".trim($row_data["cNoKTP"])."', '".trim($row_data["cLongi"])."', '".trim($row_data["cLati"])."',
        '".trim($row_data["cBulanan"])."', '".trim($row_data["cTahunan"])."', NOW(), NOW(), '0'),<br>";



	/*

	VALUES (NULL, '".trim($row_data["cKode"])."', '".trim($row_data["cNama"])."', '".trim($row_data["cAlamat1"])."', '".trim($row_data["cAlamat2"])."', '".trim($row_data["cKota"])."', '".trim($row_data["cArea"])."', '".trim($row_data["cContact"])."', '".trim($row_data["ctelp"])."', '".trim($row_data["cfax"])."',
	'".trim($row_data["cKet"])."', '".trim($row_data["nBatas"])."', '".trim($row_data["cKodePl"])."', '".trim($row_data["cNoAcc"])."', '".trim($row_data["dTglDtgAkhir"])."', '".trim($row_data["nHrKunjung"])."', '".trim($row_data["cSales"])."', '".trim($row_data["nNext"])."', '".trim($row_data["cSubArea"])."', '".trim($row_data["cDaerah"])."',
	'".trim($row_data["nNo"])."', '".trim($row_data["cMasukJd"])."', '".trim($row_data["cCab"])."', '".trim($row_data["cIntern"])."', '".trim($row_data["cNamaPers"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cUserID"])."', '".trim($row_data["cPaket"])."', '".trim($row_data["nHargaPaket"])."', '".trim($row_data["cCustInternet"])."',
	'".trim($row_data["cKdPaket"])."', '".trim($row_data["cKdOT"])."', '".trim($row_data["cNamaOT"])."', '".trim($row_data["dTglMulai"])."', '".trim($row_data["dTglBerhenti"])."','".trim($row_data["cNonAktiv"])."', '".trim($row_data["rowguid"])."', '".trim($row_data["cIncludePPN"])."', '".trim($row_data["cExcludePPN"])."',
	'".trim($row_data["cIncludePPH"])."', '".trim($row_data["cNamaKomisi"])."', '".trim($row_data["nKomisi"])."', '".trim($row_data["cUserFree"])."', '".trim($row_data["cKodeParent"])."', '".trim($row_data["cIP1"])."', '".trim($row_data["cIP2"])."', '".trim($row_data["cIP3"])."', '".trim($row_data["nterm"])."', '".trim($row_data["cMailIntern"])."',

	'".trim($row_data["cCustomInfo1"])."', '".trim($row_data["cCustomInfo2"])."', '".trim($row_data["cCustomInfo3"])."', '".trim($row_data["cCustomInfo4"])."', '".trim($row_data["cComments"])."', '".trim($row_data["dTglLahir"])."', '".trim($row_data["cMacAdd"])."', '".trim($row_data["cKdBTS"])."',
	'".trim($row_data["cNamaBTS"])."', '".trim($row_data["cNoRekVirtual"])."', '".trim($row_data["cStatus"])."', '".trim($row_data["cNamaIbu"])."', '".trim($row_data["cNoHp1"])."', '".trim($row_data["cNoHp2`,`cNoHp3`,`cBarcode"])."', '".trim($row_data["cPassword"])."',
	'".trim($row_data["cIpR1"])."', '".trim($row_data["cIpR2"])."', '".trim($row_data["cIpR3"])."', '".trim($row_data["cIpR4"])."','".trim($row_data["cAccIndex"])."', '".trim($row_data["iuserIndex"])."', '".trim($row_data["cGroupRBS"])."', '".trim($row_data["cJenis"])."', '".trim($row_data["cBaru"])."', '".trim($row_data["dTglTagihan"])."',

	'".trim($row_data["cKdNAS"])."', '".trim($row_data["NASAttribute"])."', '".trim($row_data["iGenerate"])."', '".trim($row_data["cKonversi"])."', '".trim($row_data["cKontrak"])."', '".trim($row_data["cPPHPasal23"])."', '".trim($row_data["cPPHPasal23Gx"])."');<br>";


	/*$content .= "INSERT INTO `tbCustomer` (`idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`,
	`cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`,
	`cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`,
	`cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`,
	`cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`,
	`cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`,`cNoHp3`,`cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`,
	`cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`,
	`cPPHPasal23Gx`)
	VALUES (NULL, '".trim($row_data["cKode"])."', '".trim($row_data["cNama"])."', '".trim($row_data["cAlamat1"])."', '".trim($row_data["cAlamat2"])."',
	'".trim($row_data["cKota"])."', '".trim($row_data["cArea"])."', '".trim($row_data["cContact"])."', '".trim($row_data["ctelp"])."', '".trim($row_data["cfax"])."',
	'".trim($row_data["cKet"])."', '".trim($row_data["nBatas"])."', '".trim($row_data["cKodePl"])."', '".trim($row_data["cNoAcc"])."', '".trim($row_data["dTglDtgAkhir"])."', '".trim($row_data["nHrKunjung"])."', '".trim($row_data["cSales"])."', '".trim($row_data["nNext"])."', '".trim($row_data["cSubArea"])."', '".trim($row_data["cDaerah"])."', '".trim($row_data["nNo"])."', '".trim($row_data["cMasukJd"])."', '".trim($row_data["cCab"])."',
	'".trim($row_data["cIntern"])."', '".trim($row_data["cNamaPers"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cUserID"])."', '".trim($row_data["cPaket"])."', '".trim($row_data["nHargaPaket"])."', '".trim($row_data["cCustInternet"])."', '".trim($row_data["cKdPaket"])."', '".trim($row_data["cKdOT"])."', '".trim($row_data["cNamaOT"])."', '".trim($row_data["dTglMulai"])."', '".trim($row_data["dTglBerhenti"])."',
	'".trim($row_data["cNonAktiv"])."', '".trim($row_data["rowguid"])."', '".trim($row_data["cIncludePPN"])."', '".trim($row_data["cExcludePPN"])."', '".trim($row_data["cIncludePPH"])."', '".trim($row_data["cNamaKomisi"])."', '".trim($row_data["nKomisi"])."', '".trim($row_data["cUserFree"])."', '".trim($row_data["cKodeParent"])."', '".trim($row_data["cIP1"])."', '".trim($row_data["cIP2"])."',
	'".trim($row_data["cIP3"])."', '".trim($row_data["nterm"])."', '".trim($row_data["cMailIntern"])."', '".trim($row_data["cCustomInfo1"])."', '".trim($row_data["cCustomInfo2"])."', '".trim($row_data["cCustomInfo3"])."', '".trim($row_data["cCustomInfo4"])."', '".trim($row_data["cComments"])."', '".trim($row_data["dTglLahir"])."', '".trim($row_data["cMacAdd"])."',
	'".trim($row_data["cKdBTS"])."', '".trim($row_data["cNamaBTS"])."', '".trim($row_data["cNoRekVirtual"])."', '".trim($row_data["cStatus"])."', '".trim($row_data["cNamaIbu"])."', '".trim($row_data["cNoHp1"])."', '".trim($row_data["cNoHp2`,`cNoHp3`,`cBarcode"])."', '".trim($row_data["cPassword"])."', '".trim($row_data["cIpR1"])."', '".trim($row_data["cIpR2"])."', '".trim($row_data["cIpR3"])."', '".trim($row_data["cIpR4"])."',
	'".trim($row_data["cAccIndex"])."', '".trim($row_data["iuserIndex"])."', '".trim($row_data["cGroupRBS"])."', '".trim($row_data["cJenis"])."', '".trim($row_data["cBaru"])."', '".trim($row_data["dTglTagihan"])."', '".trim($row_data["cKdNAS"])."', '".trim($row_data["NASAttribute"])."', '".trim($row_data["iGenerate"])."', '".trim($row_data["cKonversi"])."', '".trim($row_data["cKontrak"])."', '".trim($row_data["cPPHPasal23"])."',
	'".trim($row_data["cPPHPasal23Gx"])."');<br>";

	'".$row_data["cKode"]."', '".trim($row_data["cNama"])."', '".trim($row_data["cAlamat1"])."', '".trim($row_data["cAlamat2"])."', '".trim($row_data["cKota"])."',
	'".trim($row_data["cArea"])."', '".trim($row_data["cContact"])."', '".trim($row_data["ctelp"])."', '".trim($row_data["cfax"])."', '".trim($row_data["cKet"])."',
	'".trim($row_data["nBatas"])."', '".trim($row_data["cKodePl"])."', '".trim($row_data["cNoAcc"])."', '".trim($row_data["dTglDtgAkhir"])."', '".trim($row_data["nHrKunjung"])."',
	'".trim($row_data["cSales"])."', '".trim($row_data["nNext"])."', '".trim($row_data["cSubArea"])."', '".trim($row_data["cDaerah"])."', '".trim($row_data["nNo"])."',
	'".trim($row_data["cMasukJd"])."', '".trim($row_data["cPaket"])."', '".trim($row_data["nHargaPaket"])."', '".trim($row_data["cCustInternet"])."', '".trim($row_data["cKdPaket"])."',
	'".trim($row_data["cUserID"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."',
	'".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."', '".trim($row_data["cEmail"])."',
	);*/
        /*$content .='<tr>
            <td>'.$i.'<td>
            <td>'.$row_data["cKode"].'</td>
            <td>'.$row_data["cNama"].'<td>
            <td>'.$row_data["cAlamat1"].'<td>
            <td>'.$row_data["cKota"].'<td>
        </tr>';*/
	}

	$i++;
   // }
	//mysql_query($content);
	//echo "ok"
	echo $content;

