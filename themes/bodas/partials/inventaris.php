<div class="panel">
	<div class="dl-title">Data Inventaris</div>
	<div class="panel-body">

		<?php if (sizeof($mesin) > 0) { ?>
			<div class="head-tb-inventaris">Inventaris Mesin</div>
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
						<?php foreach ($mesin as $data) { ?>
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

		<?php if (sizeof($elektronik) > 0) { ?>
			<div class="head-tb-inventaris">Inventaris Elektronik</div>
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
						<?php foreach ($elektronik as $data) { ?>
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
			<div class="head-tb-inventaris">Inventaris Gedung</div>
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
			<div class="head-tb-inventaris">Inventaris Tanah</div>
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
			<div class="head-tb-inventaris">Inventaris Konstruksi</div>
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

		<?php if (sizeof($asset) > 0) { ?>
			<div class="head-tb-inventaris">Inventaris Asset Lainnya</div>
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
						<?php foreach ($asset as $data) { ?>
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

	</div>
</div>