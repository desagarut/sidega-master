<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<table>
	<tbody>
		<tr>
			<td>
				<?php if ($aksi != 'unduh') : ?>
					<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa">
				<?php endif; ?>
				<h1 class="judul">
					PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' . $this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_desa . ' ' . $config['nama_desa']); ?>
					<h1>
			</td>
		</tr>
		<tr>
			<td>
				<hr class="garis">
			</td>
		</tr>
		<tr>
			<td class="text-center">
				<h4>DAFTAR PESERTA PROGRAM <?= strtoupper($pemberdayaan_masyarakat["nama_kegiatan"]); ?></h4>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>
				<table>
					<tbody>
						<tr width="400px" >
							<td class="text-left" width="20%">Sasaran </td>
							<td>: </td>
							<td><?= $sasaran[$pemberdayaan_masyarakat["sasaran"]]; ?></td>
							<td class="text-left" width="20%">Penyelenggara</td>
							<td>: </td>
							<td><?= $pemberdayaan_masyarakat["nama_penyelenggara"]; ?></td>
						</tr>
						<tr>
							<td class="text-left" width="20%">Waktu</td>
							<td>: </td>
							<td><?= $pemberdayaan_masyarakat["tgl_mulai"]; ?> s.d <?= $pemberdayaan_masyarakat["tgl_selesai"]; ?></td>
							<td>Sumber Dana</td>
							<td>: </td>
							<td><?= $pemberdayaan_masyarakat["sumber_dana"]; ?></td>
						</tr>
						<tr>
							<td>Anggaran</td>
							<td>: </td>
							<td><?= rupiah($pemberdayaan_masyarakat["anggaran"]); ?></td>
							<td>Lokasi</td>
							<td>: </td>
							<td><?= $pemberdayaan_masyarakat["lokasi"]; ?></td>

						</tr>
						<tr>
							<td>Keterangan</td>
							<td>: </td>
							<td><?= $pemberdayaan_masyarakat["keterangan"]; ?></td>
						</tr>
					</tbody>
				</table>
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
							<th><?= $judul['judul_peserta_info']; ?></th>
							<th><?= $judul['judul_peserta_plus']; ?> </th>
							<th><?= $judul['judul_peserta_nama']; ?></th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<th>Jenis Kelamin</th>
							<th>Alamat</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($peserta as $key => $item) : ?>
							<tr>
								<td class="padat"><?= ($key + 1); ?></td>
								<td class="textx"><?= $item["peserta_info"]; ?></td>
								<td class="textx"><?= $item["peserta_plus"]; ?></td>
								<td><?= $item["peserta_nama"]; ?></td>
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