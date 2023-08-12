<style>
	img.gambar-pembangunan {
		width: 400px;
		height: 300px;
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
</style>
<table>
	<tbody>
		<tr>
			<td align="center">
				<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa">
				<h3 class="judul">DAFTAR USULAN MASYARAKAT SELURUH DESA<br/>
					<?= strtoupper($this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' ); ?>
				</h3>
			</td>
		</tr>
		<tr>
			<td>
				<hr class="garis">
			</td>
		</tr>
		<table>
            <thead>
                <tr class="border thick">
                    <th>No</th>  
                    <th>Nama Desa</th> 
                    <th>Bidang</th>
                    <th>Nama Program Kegiatan</th>
                    <th>Lokasi</th>
                    <th>Volume</th>
                    <th>Satuan</th>
                    <th>Jumlah (Rp)</th>
                    <th>Sumber Dana</th> 
                </tr>          
            </thead>
			<tbody>
				<?php foreach ($perencanaan_desa as $data): ?>
				<tr>
					<td><?= $data['id']?></td>
					<td><?= $data['desa'] ?></td>
					<td> <?= $data['nama_program_kegiatan'] ?></td>
					<td> <?= $data['bidang_desa'] ?></td>
					<td> <?= $data['lokasi'] ?></td>
					<td> <?= $data['volume'] ?></td>
					<td> <?= $data['satuan'] ?></td>
					<td> <?= $data['anggaran'] ?></td>
					<td> <?= $data['sumber_dana'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<table>
			<tbody>
				<?php foreach ($dokumentasi as $value) : ?>
					<tr>
						<td class="text-center">
							<h4><?= $value->keterangan . ' ' . $value->persentase ?></h4>
							<img class="gambar-pembangunan" src="<?= base_url() . LOKASI_GALERI . $value->gambar ?>" alt="<?= $musdus->judul ?>">
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</tbody>
</table>
