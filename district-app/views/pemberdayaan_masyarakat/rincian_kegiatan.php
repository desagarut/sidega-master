<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="box-body">
	<h5><b>Program Kegiatan</b></h5>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover tabel-rincian">
			<tbody>
				<tr>
					<td width="20%">Nama Program Kegiatan</td>
					<td width="1%">:</td>
					<td><?= strtoupper($kegiatan["nama_kegiatan"]); ?></td>
				</tr>
				<tr>
					<td>Sasaran Peserta</td>
					<td>:</td>
					<td><?= $sasaran[$kegiatan["sasaran"]]; ?></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><?= $kegiatan["keterangan"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
