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
				<h3>BUKU KADER PEMBERDAYAAN MASYARAKAT</h3>
			</td>
		</tr>
		<?php
            $tahun = date('Y', strtotime($tgl_cetak));
            if ($tahun):
        ?>
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
							<th>No. Urut</th>
							<th>Nama</th>
							<th>Umur</th>
							<th>Jenis Kelamin</th>
							<th>Pendidikan / Kursus</th>
							<th>Bidang</th>
							<th>Alamat</th>
							<th>Keterangan</th>
						</tr>
						<tr class="border thick">
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
							<th>8</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $key => $item): ?>
							<tr>
							<td align="center"><?= ($key + 1); ?></td>
								<td class="textx"><?= $item->nama; ?></td>
								<td align="center"><?= $item->umur; ?></td>
								<td align="center"><?= $item->jk; ?></td>
								<td><?= str_replace(',', ', ', $item->pendidikan . '<br/>' . preg_replace('/[^a-zA-Z, ]/', '', $item->kursus)); ?></td>
								<td><?= str_replace(',', ', ', preg_replace('/[^a-zA-Z, ]/', '', $item->bidang)); ?></td>
								<td><?= $item->alamat; ?></td>
								<td><?= $item->keterangan; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>