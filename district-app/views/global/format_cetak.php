<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
	if ($aksi == 'unduh')
	{
		header("Content-type: application/xls");
		header("Content-Disposition: attachment; filename=" . namafile($file) . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php if ($aksi == 'cetak') $this->load->view('print/headjs') ?>
	<head>
		<title><?= ucwords($file); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="<?= base_url('assets/css/report.css'); ?>" rel="stylesheet">
	</head>
	<body>
		<div id="container">
			<div id="body">
				<!-- Isi Cetak/Unduh Data Disni -->
				<?php $this->load->view($isi); ?>
			</div>
			<br />
			<table width="100%">
				<tr>
					<td colspan="<?= $letak_ttd[0]; ?>" width="10%">&nbsp;</td>
					<?php if(!empty($pamong_ketahui)) :?>
						<td colspan="<?= $letak_ttd[1]; ?>" width="20%">
							Mengetahui
							<br><?= strtoupper($pamong_ketahui['jabatan']) . ' ' . strtoupper($config['nama_desa'])?>
							<br><br><br><br>
							<br><u>( <?= $pamong_ketahui['nama'] ?? $pamong_ketahui['pamong_nama']?> )</u>
							<br><?= $this->setting->sebutan_nip_desa  ?>/NIP : <?= $pamong_ketahui['pamong_nip']?>
						</td>
					<?php endif; ?>
					<td colspan="<?= $letak_ttd[2]; ?>" width="40%">&nbsp;</td>
					<td width="20%" nowrap>
						<?= ucwords($this->setting->sebutan_desa) . ' ' . $config['nama_desa']?>, <?= tgl_indo($tgl_cetak ? date("Y m d", strtotime($tgl_cetak)) : date("Y m d"))?>
						<br><?= strtoupper($pamong_ttd['jabatan']) . ' ' . strtoupper($config['nama_desa'])?>
						<br><br><br><br>
						<br><u>( <?= $pamong_ttd['nama'] ?? $pamong_ttd['pamong_nama'] ?> )</u>
						<br><?= $this->setting->sebutan_nip_desa  ?>/NIP : <?= $pamong_ttd['pamong_nip']?>
					</td>
					<td width="10%">&nbsp;</td>
				</tr>
			</table>
		</div>
	</body>
</html>
