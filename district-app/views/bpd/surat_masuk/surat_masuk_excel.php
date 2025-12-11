<?php
	header("Content-type: application/octet-stream");
	if (empty($_SESSION['filter']))
		$tahun = "_semua";
	else
		$tahun = "_".$_SESSION['filter'];
	header("Content-Disposition: attachment; filename=bpd_surat_masuk".$tahun.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	include("district-app/views/bpd/surat-masuk/surat_masuk_print.php");
?>
