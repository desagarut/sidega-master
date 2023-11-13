<h5><b>Rincian Program/Kegiatan</b></h5>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover tabel-rincian">
		<tbody>
			<tr>
				<td width="20%">Nama Program/Kegiatan</td>
				<td width="1">:</td>
				<td><?= strtoupper($detail["nama"]); ?></td>
			</tr>
			<tr>
				<td>Sasaran Peserta</td>
				<td> : </td>
				<td><?= $sasaran[$detail["sasaran"]]?></td>
			</tr>
			<tr>
				<td>Penyelenggara</td>
				<td> : </td>
				<td><?= $detail["penyelenggara"]?></td>
			</tr>
			<tr>
				<td>Sumber Dana</td>
				<td> : </td>
				<td><?= $detail["asaldana"]?></td>
			</tr>
			<tr>
				<td>Anggaran</td>
				<td> : </td>
				<td><?= Rupiah($detail["anggaran"])?></td>
			</tr>
			<tr>
				<td>Lokasi</td>
				<td> : </td>
				<td><?= $detail["lokasi"]?></td>
			</tr>
			<tr>
				<td>Waktu Pelaksanaan</td>
				<td> : </td>
				<td><?= fTampilTgl($detail["sdate"],$detail["edate"])?></td>
			</tr>
			<tr>
				<td>Deskripsi Program / Kegiatan</td>
				<td> : </td>
				<td><?= $detail["ndesc"]?></td>
			</tr>
		</tbody>
	</table>
</div>
<br>
