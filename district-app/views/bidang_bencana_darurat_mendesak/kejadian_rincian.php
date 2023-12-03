<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box-body">
	<h5><b>Rincian Kejadian Bencana</b></h5>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover tabel-rincian">
			<tbody>
				<tr>
					<td width="15%">Kejadian Bencana</td>
					<td width="1%">:</td>
					<td width="20%"><?= $kelompok_bencana[$kejadian_bencana["kelompok_bencana"]]; ?> - <?= $kejadian_bencana["jenis_bencana"]; ?></td>
					<td width="15%">Waktu Kejadian</td>
					<td width="1%">:</td>
					<td width="20%"><?= tgl_indo_out($kejadian_bencana["tanggal_kejadian"]); ?> - Pukul <?= $kejadian_bencana["waktu_kejadian"]; ?></td>
				</tr>
				<tr>
					<td width="15%">Lokasi Bencana</td>
					<td width="1%">:</td>
					<td><?= $kejadian_bencana["lokasi_bencana"]; ?></td>
					<td width="15%">Kerusakan</td>
					<td width="1%">:</td>
					<td>Bangunan: <?= $kejadian_bencana["kerusakan_bangunan"]; ?><br/>Lintas Sektor: <?= $kejadian_bencana["kerusakan_ls"]; ?></td>
				</tr>
				<tr>
					<td width="15%">Jumlah Korban</td>
					<td width="1%">:</td>
					<td>Meninggal: <?= $kejadian_bencana["korban_meninggal"]; ?><br/>Luka Berat: <?= $kejadian_bencana["korban_lukaberat"]; ?><br/>Luka Ringan: <?= $kejadian_bencana["korban_ringan"]; ?></td>
					<td>Sumber Informasi</td>
					<td width="1%">:</td>
					<td><i class="fa fa-user" style="color:blueviolet"></i><?= $kejadian_bencana["nama_pelapor"]; ?><br/><i class="fa fa-map-marker" style="color:blueviolet"></i><?= $kejadian_bencana["alamat_pelapor"]; ?><br/><i class="fa fa-phone" style="color:blueviolet"></i><?= $kejadian_bencana["nomor_pelapor"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>