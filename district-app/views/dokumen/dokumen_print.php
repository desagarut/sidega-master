<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Laporan Dokumen</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="<?= base_url()?>assets/css/report.css" rel="stylesheet" type="text/css">
		<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")): ?>
			<link rel="shortcut icon" href="<?= base_url()?><?= LOKASI_LOGO_DESA?>favicon.ico" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?= base_url()?>favicon.ico" />
		<?php endif; ?>
		<style>
			.textx
			{
				mso-number-format:"\@";
			}
			td,th
			{
				font-size:6.5pt;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="body">
				<div class="header" align="center">
					<label align="left"><?= get_identitas()?></label>
					<h3> DAFTAR <?= strtoupper($kategori) ?> <?= !empty($tahun) ? 'TAHUN '. $tahun : ''?></h3>
					<br>
				</div>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th>No</th>
							<th>Judul / Tentang</th>
							<?php if ($kat == 1): ?>
								<th>Tahun</th>
							<?php elseif ($kat == 2): ?>
								<th>Nomor Dan Tanggal Keputusan</th>
								<th>Uraian Singkat</th>
							<?php elseif ($kat == 3): ?>
								<th>Nomor Dan Tanggal Ditetapkan</th>
								<th>Uraian Singkat</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $data): ?>
						<tr>
							<td><?= $data['no']?></td>
							<td><?= $data['nama']?></td>
							<?php if ($kat == 1): ?>
								<td align="center"><?= $data['tahun']?></td>
							<?php elseif ($kat == 2): ?>
								<td><?= $data['attr']['no_kep_kades']." / ".$data['attr']['tgl_kep_kades']?></td>
								<td><?= $data['attr']['uraian']?></td>
							<?php elseif ($kat == 3): ?>
								<td><?= $data['attr']['no_ditetapkan']." / ".$data['attr']['tgl_ditetapkan']?></td>
								<td><?= $data['attr']['uraian']?></td>
							<?php endif; ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<br>
			<label>Tanggal cetak : &nbsp; </label><?= tgl_indo(date("Y m d"))?>
		</div>
	</body>
</html>
