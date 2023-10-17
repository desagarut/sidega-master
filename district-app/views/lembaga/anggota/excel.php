<?php
	$tgl =  date('d_m_Y');
	$nk = $lembaga['nama'];
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=data_anggota_lembaga_$nk_$tgl.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	include("district-app/views/lembaga/anggota/cetak.php");
?>
