<div class="panel">
	<h4>Data Inventaris Desa</h4>
	<div class="panel-body">

		<?php if (sizeof($peralatan) > 0) { ?>
			<div class="head-tb-inventaris">Kategori : Inventaris Peralatan</div>
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
			<div class="head-tb-inventaris">Kategori : Inventaris Gedung</div>
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
			<div class="head-tb-inventaris">Kategori : Inventaris Tanah</div>
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
						<?php foreach ($tanah as $data) { ?>
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

		<?php if (sizeof($kontruksi) > 0) { ?>
			<div class="head-tb-inventaris">Kategori : Inventaris Konstruksi</div>
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
			<div class="head-tb-inventaris">Kategori : Inventaris Konstruksi</div>
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
			<div class="head-tb-inventaris">Kategori : Inventaris Asset Lainnya</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center uppercase">Kelompok</th>
							<th class="text-center uppercase">Jenis</th>
							<th class="text-center uppercase">Kode</th>
							<th class="text-center uppercase">Jumlah</th>
							<th class="text-center uppercase">Tahun</th>
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
								<td class="text-center"><?= $data->asal; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } ?>
	</div>
</div>