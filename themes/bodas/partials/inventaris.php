<div class="panel">
	<div class="panel-head text-center">
	<h3>Data Inventaris Desa</h3>
	</div>
	<div class="panel-body">
		<?php if (sizeof($peralatan) > 0) { ?>
			<div class="head-tb-inventaris"><h5 class="pt-2">Kategori : Inventaris Peralatan</h5></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Nama Barang</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-center uppercase">Merk/Type</th>
							<th class="text-center uppercase">Tahun Pembelian</th>
							<th class="text-center uppercase">Sumber Dana</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($peralatan as $data) { ?>
							<tr <?php echo ($data->status == "1") ? 'style="background-color:#cacaca"' : ''; ?>>
								<td><?= $data->nama_barang; ?></td>
								<td class="text-center"><?= $data->kode_barang; ?></td>
								<td><?= $data->merk; ?></td>
								<td class="text-center"><?= $data->tahun_pengadaan; ?></td>
								<td><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>

		<?php if (sizeof($gedung) > 0) { ?>
			<div class="head-tb-inventaris"><h5 class="pt-2">Kategori : Inventaris Gedung</h5></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Nama Barang</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-center uppercase">Tanggal Dokumen</th>
							<th class="text-center uppercase">Sumber Dana</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($gedung as $data) { ?>
							<tr <?php echo ($data->status == "1") ? 'style="background-color:#cacaca"' : ''; ?>>
								<td><?= $data->nama_barang; ?></td>
								<td class="text-center"><?= $data->kode_barang; ?></td>
								<td class="text-center"><?= $data->tanggal_dokument; ?></td>
								<td><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>

		<?php if (sizeof($tanah) > 0) { ?>
			<div class="head-tb-inventaris"><h5 class="pt-2">Kategori : Inventaris Tanah</h5></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Nama Barang</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-left uppercase">Letak</th>
							<th class="text-left uppercase">Penggunanaan</th>
							<th class="text-center uppercase">Tahun Perolehan</th>
							<th class="text-left uppercase">Keterangan</th>
							<th class="text-center uppercase">Sumber Dana</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($tanah as $data) { ?>
							<tr <?php echo ($data->status == "1") ? 'style="background-color:#cacaca"' : ''; ?>>
								<td><?= $data->nama_barang; ?></td>
								<td class="text-center"><?= $data->kode_barang; ?></td>
								<td class="text-center"><?= $data->letak; ?></td>
								<td class="text-center"><?= $data->penggunaan; ?></td>
								<td class="text-center"><?= $data->tanggal_pengadaan; ?></td>
								<td class="text-center"><?= $data->keterangan; ?></td>
								<td><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>

		<?php if (sizeof($kontruksi) > 0) { ?>
			<div class="head-tb-inventaris"><h5 class="pt-2">Kategori : Inventaris Konstruksi</h5></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Nama Barang</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-center uppercase">Tanggal Dokumen</th>
							<th class="text-center uppercase">Sumber Dana</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($kontruksi as $data) { ?>
							<tr <?php echo ($data->status == "1") ? 'style="background-color:#cacaca"' : ''; ?>>
								<td><?= $data->nama_barang; ?></td>
								<td class="text-center"><?= $data->kode_barang; ?></td>
								<td class="text-center"><?= $data->tanggal_dokument; ?></td>
								<td><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>

		<?php if (sizeof($jalan) > 0) { ?>
			<div class="head-tb-inventaris"><h5 class="pt-2">Kategori : Inventaris Jalan</h5></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Nama Barang</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-center uppercase">Tanggal Dokumen</th>
							<th class="text-center uppercase">Sumber Dana</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($jalan as $data) { ?>
							<tr <?php echo ($data->status == "1") ? 'style="background-color:#cacaca"' : ''; ?>>
								<td><?= $data->nama_barang; ?></td>
								<td class="text-center"><?= $data->kode_barang; ?></td>
								<td class="text-center"><?= $data->tanggal_dokument; ?></td>
								<td><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>

		<?php if (sizeof($asset) > 0) { ?>
			<div class="head-tb-inventaris"><h5 class="pt-2">Kategori : Inventaris Asset Lainnya</h5></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Kelompok</th>
							<th class="text-center uppercase">Jenis</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-center uppercase">Jumlah</th>
							<th class="text-center uppercase">Tahun</th>
							<th class="text-center uppercase">Keterangan</th>
							<th class="text-center uppercase">Sumber</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($asset as $data) { ?>
							<tr <?php echo ($data->status == "1") ? 'style="background-color:#cacaca"' : ''; ?>>
								<td><?= $data->nama_barang; ?></td>
								<td class="text-center"><?= $data->jenis; ?></td>
								<td class="text-center"><?= $data->kode_barang; ?></td>
								<td class="text-center"><?= $data->jumlah; ?></td>
								<td class="text-center"><?= $data->tahun_pengadaan; ?></td>
								<td class="text-left"><?= $data->keterangan; ?></td>
								<td class="text-center"><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>
	</div>
</div>