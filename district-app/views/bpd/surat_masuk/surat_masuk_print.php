<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>BPD - Buku Surat Masuk</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")): ?>
		<link rel="shortcut icon" href="<?= base_url() ?><?= LOKASI_LOGO_DESA ?>favicon.ico" />
	<?php else: ?>
		<link rel="shortcut icon" href="<?= base_url() ?>favicon.ico" />
	<?php endif; ?>
	<link href="<?= base_url() ?>assets/css/report.css" rel="stylesheet" type="text/css">
	<style>
		.textx {
			mso-number-format: "\@";
		}

		td.bold {
			font-weight: bold;
		}

		td.underline {
			border-bottom: solid 1px;
		}
	</style>
</head>

<body>
	<div id="container">
		<!-- Print Body -->
		<div id="body">
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align='right' width='50px'>
						<img src="<?= base_url("assets/files/logo/bpd.png") ?>" style="padding-right:20px" class="img-fluid responsive" width="70px" height="70px" title="BPD" alt="BPD">
					</td>
					<td>
						<h3> BADAN PERMUSYAWARATAN DESA </h3>
						<h5> <?= strtoupper($this->setting->sebutan_desa) ?> <?= strtoupper($desa['nama_desa']) ?> KEC. <?= strtoupper($desa['nama_kecamatan']) ?></h5>
						<h5>KAB. <?= strtoupper($desa['nama_kecamatan']) ?> PROV. JAWA BARAT</h5>
					</td>
				</tr>
				<tr>
					<td class="underline nowrap">&nbsp;</td>
					<td class="underline nowrap">&nbsp;</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align='center'>
						<h3>BUKU SURAT MASUK</h3>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			<table class="border thick">
				<thead>
					<tr class="border thick">
						<th>No.</th>
						<th>Tanggal Penerimaan</th>
						<th>Nomor Surat</th>
						<th>Tanggal Surat</th>
						<th>Pengirim</th>
						<th>Isi Singkat</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($main as $data): ?>
						<tr>
							<td align="center"><?= $data['nomor_urut'] ?></td>
							<td><?= tgl_indo($data['tanggal_penerimaan']) ?> </td>
							<td><?= $data['nomor_surat'] ?></td>
							<td><?= tgl_indo($data['tanggal_surat']) ?></td>
							<td><?= $data['pengirim'] ?></td>
							<td><?= $data['isi_singkat'] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<table>
				<?php include("district-app/views/bpd/anggota/blok_ttd_bpd.php"); ?>
		</div>
	</div>
</body>