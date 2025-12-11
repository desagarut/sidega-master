<h5><b>Detail Buku Aspirasi Masyarakat</b></h5>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover tabel-rincian">
		<tbody>
			<tr>
				<td width="20%">Nama Buku</td>
				<td width="1">:</td>
				<td><?= strtoupper($detail["nama"]); ?></td>
			</tr>
			<tr>
				<td>Tahun Buku</td>
				<td> : </td>
				<td><?= $detail["tahun"]?></td>
			</tr>
			<tr>
				<td>Kelompok Pemberi Aspirasi</td>
				<td> : </td>
				<td><?= $sasaran[$detail["sasaran"]]?></td>
			</tr>
			<tr>
				<td>Periode Buku</td>
				<td> : </td>
				<td><?= fTampilTgl($detail["sdate"],$detail["edate"])?></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td> : </td>
				<td><?= $detail["ndesc"]?></td>
			</tr>
		</tbody>
	</table>
</div>
<br>
