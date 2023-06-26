<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="box-body">
	<h5>Nama Kelompok Data :  <b><?= strtoupper($data_kemiskinan["nama"]); ?></b></h5>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover tabel-rincian">
			<tbody>
				<tr>
					<td width="20%">Nama Data</td>
					<td width="1%">:</td>
					<td><?= strtoupper($data_kemiskinan["nama"]); ?></td>
				</tr>
				<tr>
					<td>Tahun</td>
					<td>:</td>
					<td><?= $data_kemiskinan["tahun"]; ?></td>
				</tr>
				<tr>
					<td>Sasaran Terdata</td>
					<td>:</td>
					<td><?= $sasaran[$data_kemiskinan["sasaran"]]; ?></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><?= $data_kemiskinan["keterangan"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
