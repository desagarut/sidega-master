<?php

	header("Content-type: application/xls");
	header("Content-Disposition: attachment; filename=Daftar SPPT PBB_".date('Y-m-d').".xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	$this->load->view('data_sppt/sppt_cetak');
?>
