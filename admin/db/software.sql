-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2014 at 04:39 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `software`
--

-- --------------------------------------------------------

--
-- Table structure for table `gxLogin`
--

CREATE TABLE IF NOT EXISTS `gxLogin` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `customer_number` char(10) NOT NULL,
  `id_voip` varchar(50) NOT NULL,
  `id_vod` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `password_date` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `mac` varchar(20) NOT NULL,
  `user_service` int(11) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `filter_name` varchar(128) NOT NULL,
  `start_date` datetime NOT NULL,
  `user_expiry_date` datetime NOT NULL,
  `manual_expiration_date` datetime NOT NULL,
  `suspend_date` datetime NOT NULL,
  `user_active` enum('yes','no') NOT NULL DEFAULT 'no',
  `account_index` int(11) NOT NULL,
  `user_time_bank` int(11) NOT NULL,
  `user_kb_bank` int(11) NOT NULL,
  `user_dollar_bank` int(11) NOT NULL,
  `user_balance` int(11) NOT NULL,
  `user_payment_balance` int(11) NOT NULL,
  `time_online` int(11) NOT NULL,
  `callback_number` varchar(128) NOT NULL,
  `group` enum('super_admin','admin','manager','kabag','staff','marketing','teknisi','riset','na','cso','satpam','klien') NOT NULL,
  `caller_id` int(11) NOT NULL,
  `lockout` int(11) NOT NULL,
  `lockout_time` datetime NOT NULL,
  `lockout_count` int(11) NOT NULL,
  `grace_period_expiration` int(11) NOT NULL,
  `nas_attributes` int(11) NOT NULL,
  `user_ip_lastvisit` varchar(20) NOT NULL,
  `lastvisit` datetime NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gxSessions`
--

CREATE TABLE IF NOT EXISTS `gxSessions` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `sess_id` varchar(200) NOT NULL,
  `expired_session` datetime NOT NULL,
  `id_login` int(10) NOT NULL,
  `logged` varchar(1) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `url` varchar(250) NOT NULL,
  `browser` varchar(250) NOT NULL,
  `os` varchar(250) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbCustomer`
--

CREATE TABLE IF NOT EXISTS `tbCustomer` (
  `idCustomer` int(10) NOT NULL AUTO_INCREMENT,
  `cKode` char(10) NOT NULL,
  `cNama` varchar(50) NOT NULL,
  `cAlamat1` varchar(50) NOT NULL,
  `cAlamat2` varchar(50) NOT NULL,
  `cKota` varchar(50) NOT NULL,
  `cArea` varchar(10) NOT NULL,
  `cContact` varchar(20) NOT NULL,
  `ctelp` varchar(50) NOT NULL,
  `cfax` varchar(30) NOT NULL,
  `cKet` varchar(50) NOT NULL,
  `nBatas` float(18,2) NOT NULL,
  `cKodePl` char(3) NOT NULL,
  `cNoAcc` char(10) NOT NULL,
  `dTglDtgAkhir` datetime NOT NULL,
  `nHrKunjung` float(10,0) NOT NULL,
  `cSales` char(5) NOT NULL,
  `nNext` float(10,0) NOT NULL,
  `cSubArea` varchar(10) NOT NULL,
  `cDaerah` varchar(20) NOT NULL,
  `nNo` float(18,0) NOT NULL,
  `cMasukJd` char(1) NOT NULL,
  `cCab` char(1) NOT NULL,
  `cIntern` char(1) NOT NULL,
  `cNamaPers` varchar(50) NOT NULL,
  `cEmail` varchar(200) NOT NULL,
  `cUserID` varchar(100) NOT NULL,
  `cPaket` varchar(40) NOT NULL,
  `nHargaPaket` float(19,2) NOT NULL,
  `cCustInternet` char(1) NOT NULL,
  `cKdPaket` varchar(20) NOT NULL,
  `cKdOT` varchar(20) NOT NULL,
  `cNamaOT` varchar(40) NOT NULL,
  `dTglMulai` datetime NOT NULL,
  `dTglBerhenti` datetime NOT NULL,
  `cNonAktiv` char(1) NOT NULL,
  `rowguid` varchar(50) NOT NULL,
  `cIncludePPN` char(1) NOT NULL,
  `cExcludePPN` char(1) NOT NULL,
  `cIncludePPH` char(1) NOT NULL,
  `cNamaKomisi` varchar(30) NOT NULL,
  `nKomisi` float(18,2) NOT NULL,
  `cUserFree` varchar(50) NOT NULL,
  `cKodeParent` char(1) NOT NULL,
  `cIP1` varchar(200) NOT NULL,
  `cIP2` varchar(200) NOT NULL,
  `cIP3` varchar(50) NOT NULL,
  `nterm` float(18,2) NOT NULL,
  `cMailIntern` varchar(50) NOT NULL,
  `cCustomInfo1` varchar(50) NOT NULL,
  `cCustomInfo2` varchar(50) NOT NULL,
  `cCustomInfo3` varchar(50) NOT NULL,
  `cCustomInfo4` varchar(50) NOT NULL,
  `cComments` varchar(255) NOT NULL,
  `dTglLahir` datetime NOT NULL,
  `cMacAdd` varchar(50) NOT NULL,
  `cKdBTS` varchar(10) NOT NULL,
  `cNamaBTS` varchar(30) NOT NULL,
  `cNoRekVirtual` varchar(20) NOT NULL,
  `cStatus` char(1) NOT NULL,
  `cNamaIbu` varchar(50) NOT NULL,
  `cNoHp1` varchar(15) NOT NULL,
  `cNoHp2` varchar(15) NOT NULL,
  `cNoHp3` varchar(15) NOT NULL,
  `cBarcode` varchar(20) NOT NULL,
  `cPassword` varchar(32) NOT NULL,
  `cIpR1` int(10) NOT NULL,
  `cIpR2` int(10) NOT NULL,
  `cIpR3` int(10) NOT NULL,
  `cIpR4` int(10) NOT NULL,
  `cAccIndex` int(10) NOT NULL,
  `iuserIndex` int(10) NOT NULL,
  `cGroupRBS` varchar(16) NOT NULL,
  `cJenis` char(1) NOT NULL,
  `cBaru` char(1) NOT NULL,
  `dTglTagihan` datetime NOT NULL,
  `cKdNAS` varchar(10) NOT NULL,
  `NASAttribute` text NOT NULL,
  `iGenerate` int(10) NOT NULL,
  `cKonversi` char(1) NOT NULL,
  `cKontrak` char(1) NOT NULL,
  `cPPHPasal23` char(1) NOT NULL,
  `cPPHPasal23Gx` char(1) NOT NULL,
  `cKdProspek` varchar(12) NOT NULL,
  `cNoKTP` varchar(32) NOT NULL,
  `cLongi` varchar(32) NOT NULL,
  `cLati` varchar(32) NOT NULL,
  `cBulanan` char(1) NOT NULL,
  `cTahunan` char(1) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`idCustomer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
