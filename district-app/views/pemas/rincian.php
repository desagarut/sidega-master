<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box-body">
	<h5><b>Rincian Program Kegiatan</b></h5>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover tabel-rincian">
			<tbody>
				<tr>
					<td width="15%">Nama Program / Kegiatan</td>
					<td width="1%">:</td>
					<td width="15%"><?= strtoupper($pemas["nama_kegiatan"]); ?></td>
					<td width="15%">Sumber Dana</td>
					<td width="1%">:</td>
					<td width="15%"><?= $pemas["sumber_dana"]; ?></td>
					<td width="15%"></td>
					<td>:</td>
					<td width="15%"></td>
				</tr>
				<tr>
					<td width="15%">Sasaran</td>
					<td width="1%">:</td>
					<td><?= $sasaran[$pemas["sasaran"]]; ?></td>
					<td width="15%">Anggaran</td>
					<td width="1%">:</td>
					<td><?= rupiah($pemas["anggaran"]); ?></td>
					<td></td>
					<td width="1%">:</td>
					<td></td>
				</tr>
				<tr>
					<td width="15%">Waktu</td>
					<td width="1%">:</td>
					<td><?= tgl_indo_out($pemas["tgl_mulai"]); ?> - <?= tgl_indo_out($pemas["tgl_selesai"]); ?></td>
					<td>Lokasi</td>
					<td width="1%">:</td>
					<td><?= $pemas["lokasi"]; ?></td>
					<td>Keterangan</td>
					<td width="1%">:</td>
					<td><?= $pemas["keterangan"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>