<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<table>
	<tbody>
		<tr>
			<td>
				<?php if ($aksi != 'unduh') : ?>
					<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa">
				<?php endif; ?>
				<h1 class="judul">
					PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' . $this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_desa . ' ' . $config['nama_desa']); ?>
				</h1>
			</td>
		</tr>
		<tr>
			<td>
				<hr class="garis">
			</td>
		</tr>
		<tr>
			<td class="text-center">
				<h4>DAFTAR RENCANA KERJA PEMERINTAH DESA</h4>
			</td>
		</tr>
		<?php if ($tahun) : ?>
			<tr>
				<td class="text-center">
					<h4>TAHUN <?= $tahun; ?></h4>
				</td>
			</tr>
		<?php endif; ?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th>NOMOR URUT</th>
							<th>NAMA PROGRAM / KEGIATAN</th>
							<th>LOKASI</th>
							<th>SUMBER DANA</th>
							<th>ANGGARAN</th>
							<th>VOLUME</th>
							<th>PELAKSANA</th>
							<th>MANFAAT</th>
							<th>KET</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $key => $data) : ?>
							<tr>
								<td align="center"><?= ($key + 1) ?></td>
								<td><?= $data->nama_program_kegiatan; ?></td>
								<td><?= $data->lokasi; ?></td>
								<td align="right"><?= $data->sumber_dana; ?></td>
								<td align="right"><?= Rupiah2($data->anggaran); ?></td>
								<td align="right"><?= Rupiah2($data->volume); ?></td>
								<td><?= $data->pelaksana_kegiatan; ?></td>
								<td><?= $data->manfaat; ?></td>
								<td><?= $data->keterangan; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>