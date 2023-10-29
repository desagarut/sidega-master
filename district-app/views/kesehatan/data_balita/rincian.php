<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="box-body">
	<h5><b>Rincian Kelompok Data</b></h5>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover tabel-rincian">
			<tbody>
				<tr>
					<td width="20%">Nama Kelompok Data</td>
					<td width="1%">:</td>
					<td><?= strtoupper($data_balita["nama"]); ?></td>
				</tr>
				<tr>
					<td>Sasaran</td>
					<td>:</td>
					<td><?= $sasaran[$data_balita["sasaran"]]; ?></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><?= $data_balita["keterangan"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
