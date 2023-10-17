<style>
	.textx
	{
		mso-number-format:"\@";
	}
	td, th
	{
		font-size:9pt;
	}
	table#ttd td
	{
		text-align: center;
		white-space: nowrap;
	}
	.underline
	{
		text-decoration: underline;
	}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php if ($aksi == 'unduh'): ?>
			<?php
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=Lembaran_desa_".date('Y-m-d').".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
		<?php endif; ?>

		<title>Lembaran dan Berita Desa</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="<?= base_url()?>assets/css/report.css" rel="stylesheet" type="text/css">
		<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")): ?>
			<link rel="shortcut icon" href="<?= base_url()?><?= LOKASI_LOGO_DESA?>favicon.ico" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?= base_url()?>favicon.ico" />
		<?php endif; ?>
	</head>
	<body>
		<div id="container">
			<div id="body">
				<div class="header" align="center">
					<h3>A.9 BUKU LEMBARAN DESA DAN BERITA DESA</h3>
					<h4><?= strtoupper($this->setting->sebutan_desa.' '.$desa['nama_desa']. $this->setting->sebutan_kecamatan.' '.$desa['nama_kecamatan'].' '.$this->setting->sebutan_kabupaten.' '.$desa['nama_kabupaten'])?></h4>
					<h4><?= !empty($tahun) ? 'TAHUN '. $tahun : ''?></h4>
					<br>
				</div>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th rowspan="2">NOMOR URUT</th>
							<th rowspan="2">JENIS PERATURAN DI DESA</th>
							<th rowspan="2">NOMOR DAN TANGGAL DITETAPKAN</th>
							<th rowspan="2">TENTANG</th>
							<th colspan="2">DIUNDANGKAN</th>
							<th rowspan="2">KET.</th>
						</tr>
						<tr class="border thick">
							<th>TANGGAL</th>
							<th>NOMOR</th>
						</tr>
						<tr class="border thick">
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $data): ?>
						<tr>
							<td class="padat"><?= $data['no']?></td>
							<td><?= $data['attr']['jenis_peraturan']?></td>
							<td><?= 'Nomor '.strip_kosong($data['attr']['no_ditetapkan']).", Tanggal ".tgl_indo_dari_str($data['attr']['tgl_ditetapkan'])?></td>
							<td><?= $data['nama']?></td>
							<td><?= tgl_indo_dari_str($data['attr']['tgl_lembaran_desa'])?></td>
							<td><?= strip_kosong($data['attr']['no_lembaran_desa'])?></td>
							<td><?= $data['attr']['keterangan']?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<br><br>
				<table id="ttd">
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr>
						<!-- Persen untuk tampilan cetak.
								Colspan untuk tampilan unduh.
						-->
						<td colspan="1">&nbsp;</td>
						<td colspan="2" align="center">MENGETAHUI</td>
						<td colspan="3" align="center"><span class="underline"><?= strtoupper($this->setting->sebutan_desa.' '.$desa['nama_desa'].', '.tgl_indo(date("Y m d")))?></span></td>
						<td colspan="1">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="1">&nbsp;</td>
						<td colspan="2" align="center"><?= strtoupper($input['jabatan_ketahui'])?></td>
						<td colspan="3" align="center"><?= strtoupper($input['jabatan_ttd'])?></td>
						<td colspan="1">&nbsp;</td>
					</tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7">&nbsp;</td></tr>
					<tr>
						<td colspan="1">&nbsp;</td>
						<td colspan="2" align="center"><span class="underline"><?= strtoupper($input['pamong_ketahui'])?></span></td>
						<td colspan="3" align="center"><span class="underline"><?= strtoupper($input['pamong_ttd'])?></span></td>
						<td colspan="1">&nbsp;</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
