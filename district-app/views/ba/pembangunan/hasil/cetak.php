<?php defined('BASEPATH') || exit('No direct script access allowed');?>

<table>
	<tbody>
		<tr>
			<td>
				<?php if ($aksi != 'unduh'): ?>
					<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa">
				<?php endif; ?>
				<h1 class="judul">
					PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' . $this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_desa . ' ' . $config['nama_desa']); ?>
				</h1>
			</td>
		</tr>
		<tr>
			<td><hr class="garis"></td>
		</tr>
		<tr>
			<td class="text-center">
				<h4>BUKU INVENTARIS HASIL - HASIL PEMBANGUNAN</h4><br>
				<h4>TAHUN <?= $tahun; ?></h4>
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
							<th>NOMOR URUT</th>
							<th>JENIS/NAMA HASIL PEMBANGUNAN</th>
							<th>VOLUME</th>
							<th>BIAYA</th>
							<th>LOKASI</th>
							<th>KETERANGAN</th>
							</tr>
					<tr class="border thick">
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $key => $data): ?>
							<tr>
								<td align="center"><?= ($key + 1)?></td>
								<td><?= $data->nama_program_kegiatan; ?></td>
								<td align="center"><?= $data->volume; ?></td>
								<td align="right"><?= Rupiah2($data->anggaran); ?></td>
								<td align="right"><?= $data->lokasi; ?></td>
								<td align="right"><?= $data->keterangan; ?></td>

							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>