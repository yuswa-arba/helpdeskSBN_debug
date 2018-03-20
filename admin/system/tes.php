<?php
function NamaBulan($bulan)
{
	switch ($bulan){
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 01: 
			return "Januari";
			break;
		case 02:
			return "Februari";
			break;
		case 03:
			return "Maret";
			break;
		case 04:
			return "April";
			break;
		case 05:
			return "Mei";
			break;
		case 06:
			return "Juni";
			break;
		case 07:
			return "Juli";
			break;
		case 08:
			return "Agustus";
			break;
		case 09:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

echo NamaBulan(date("n", strtotime("01-01-2015")));
echo NamaBulan(date("n", strtotime("01-02-2015")));
echo NamaBulan(date("n", strtotime("01-03-2015")));
echo NamaBulan(date("n", strtotime("01-04-2015")));
echo NamaBulan(date("n", strtotime("01-05-2015")));
echo NamaBulan(date("n", strtotime("01-06-2015")));
echo NamaBulan(date("n", strtotime("01-07-2015")));
echo NamaBulan(date("n", strtotime("01-08-2015")));
echo NamaBulan(date("n", strtotime("01-09-2015")));
echo NamaBulan(date("n", strtotime("01-10-2015")));
echo NamaBulan(date("n", strtotime("01-11-2015")));
echo NamaBulan(date("n", strtotime("01-12-2015")));

echo (date("j", strtotime("01-01-2015")));
echo (date("j", strtotime("01-02-2015")));
echo (date("j", strtotime("01-03-2015")));
echo (date("j", strtotime("01-04-2015")));
echo (date("j", strtotime("01-05-2015")));
echo (date("j", strtotime("01-06-2015")));
echo (date("m", strtotime("01-07-2015")));
echo (date("m", strtotime("01-08-2015")));
echo (date("m", strtotime("01-09-2015")));
echo (date("m", strtotime("01-10-2015")));
echo (date("m", strtotime("01-11-2015")));
echo (date("m", strtotime("01-12-2015")));