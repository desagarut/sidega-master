<?php
	header("Content-type: application/xls");
	header("Content-Disposition: attachment; filename=rtm_".date("Y-m-d").".xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	include("district-app/views/sid/kependudukan/rtm_cetak.php");
?>
