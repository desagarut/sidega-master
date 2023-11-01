<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<table>
	<tbody>
		<tr>
			<td>
				<?php if ($aksi != 'unduh'): ?>
					<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa">
				<?php endif; ?>
				<h1 class="judul">
					PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' . $this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_desa . ' ' . $config['nama_desa']); ?>
				<h1>
			</td>
		</tr>
		<tr>
			<td><hr class="garis"></td>
		</tr>
		<tr>
			<td class="text-center">
				<h4><u>Daftar Terdata Suplemen <?= set_ucwords($suplemen["nama"]); ?></u></h4>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Sasaran Suplemen : </strong><?= $sasaran[$suplemen["sasaran"]];?><br>
				<strong>Keterangan : </strong><?= $suplemen["keterangan"];?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th class="padat">No</th>
							<th><?= $judul['judul_terdata_info']; ?></th>
							<th><?= $judul['judul_terdata_plus']; ?> </th>
							<th><?= $judul['judul_terdata_nama']; ?></th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<th>Jenis Kelamin</th>
							<th>Alamat</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($terdata as $key => $item): ?>
							<tr>
								<td class="padat"><?= ($key + 1); ?></td>
								<td class="textx"><?= $item["terdata_info"]; ?></td>
								<td class="textx"><?= $item["terdata_plus"]; ?></td>
								<td><?= $item["terdata_nama"]; ?></td>
								<td><?= $item["tempat_lahir"]; ?></td>
								<td class="textx"><?= $item["tanggal_lahir"]; ?></td>
								<td><?= $item["sex"]; ?></td>
								<td><?= $item["info"]; ?></td>
								<td><?= $item["keterangan"]; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
