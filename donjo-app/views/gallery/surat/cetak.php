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
				</h1>
			</td>
		</tr>
		<tr>
			<td><hr class="garis"></td>
		</tr>
		<tr>
			<td class="text-center">
				<h4><u> DATA ARSIP LAYANAN SURAT <?= strtoupper($this->setting->sebutan_desa) ?> </u></h4>
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
							<th>No</th>
							<th>No Kode Surat</th>
							<th>No Urut Surat</th>
							<th>Jenis Surat</th>
							<th>Nama Penduduk</th>
							<th>Keterangan</th>
							<th>Ditandatangani Oleh</th>
							<th>Tanggal</th>
							<th>User</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $data): ?>
							<tr>
								<td><?= $data['no']?></td>
								<td class="textx"><?= $data['kode_surat']?></td>
								<td class="textx"><?= $data['no_surat']?></td>
								<td class="textx"><?= $data['format']?></td>
								<td>
									<?php if ($data['nama']): ?>
										<?= $data['nama']; ?>
										<?php elseif ($data['nama_non_warga']): ?>
											<strong>Non-warga: </strong><?= $data['nama_non_warga']; ?><br>
											<strong>NIK: </strong><?= $data['nik_non_warga']; ?>
										<?php endif; ?>
									</td>
									<td><?= $data['keterangan']?></td>
									<td><?= $data['pamong']?></td>
									<td nowrap><?= tgl_indo($data['tanggal'])?></td>
									<td><?= $data['nama_user']?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</table>
