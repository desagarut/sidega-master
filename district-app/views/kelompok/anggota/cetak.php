<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<table>
	<tbody>
		<tr>
			<td align="center">
				<?php if ($aksi != 'unduh'): ?>
					<img src="<?= gambar_desa($config['logo']);?>" alt="" style="width:100px; height:auto">
				<?php endif; ?>
				<h1>PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten)?> <?= strtoupper($config['nama_kabupaten'])?> </h1>
				<h1 style="text-transform: uppercase;"></h1>
				<h1><?= strtoupper($this->setting->sebutan_kecamatan)?> <?= strtoupper($config['nama_kecamatan'])?> </h1>
				<h1><?= strtoupper($this->setting->sebutan_desa)." ".strtoupper($config['nama_desa'])?></h1>
			</td>
		</tr>
		<tr>
			<td style="padding: 5px 20px;">
				<hr style="border-bottom: 2px solid #000000; height:0px;">
			</td>
		</tr>
		<tr>
			<td align="center" >
				<h4><u>Daftar Anggota Kelopok <?= ucwords($kelompok['nama']); ?></u></h4>
			</td>
		</tr>
		<tr>
			<td style="padding: 5px 20px;">
				<strong>Nama Kelompok : </strong><?= $kelompok['nama']; ?><br>
				<strong>Ketua Kelompok : </strong><?= $kelompok['nama_ketua']; ?><br>
				<strong>Kategori Kelompok : </strong><?= $kelompok['kategori']; ?><br>
				<strong>Keterangan : </strong><?= $kelompok['keterangan'];?>
			</td>
		</tr>
		<tr>
			<td style="padding: 5px 20px;">
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th>NO.</th>
							<th>NO. ANGGOTA</th>
							<th>JABATAN</th>
							<th>SK JABATAN</th>
							<th>NIK</th>
							<th>NAMA</th>
							<th>TEMPAT / TANGGAL LAHIR</th>
							<th>UMUR (TAHUN)</th>
							<th>JENIS KELAMIN</th>
							<th>ALAMAT</th>
							<th>KETERANGAN</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($main as $key => $data): ?>
							<tr>
								<td align="center"><?= ($key + 1)?></td>
								<td class="textx" align="center"><?= $data['no_anggota']?></td>
								<td><?= $this->referensi_model->list_ref(JABATAN_KELOMPOK)[$data['jabatan']]?></td>
								<td><?= $data['no_sk_jabatan']?></td>
								<td class="textx"><?= $data['nik']?></td>
								<td><?= $data['nama']?></td>
								<td><?= strtoupper($data['tempatlahir'] . ' / ' . tgl_indo($data['tanggallahir']))?></td>
								<td class="textx" align="center"><?= $data['umur']?></td>
								<td><?= $data['sex']?></td>
								<td><?= $data['alamat']?></td>
								<td><?= $data['keterangan']; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
