<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<table>
	<tbody>
		<tr>
			<td colspan="8">
				<?php if ($aksi != 'unduh'): ?>
					<img class="logo" src="<?= gambar_desa($config['logo']);?>" alt="logo-desa">
				<?php endif; ?>
				<h1 class="judul">
					PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' . $this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_desa . ' ' . $config['nama_desa']); ?>
				<h1>
			</td>
		</tr>
		<tr>
			<td colspan='6'><hr class="garis"></td>
		</tr>
		<tr>
			<td colspan='6' class="text-center">
				<h4><u>Laporan Hasil Analisis <?= $judul['asubjek'] ?></u></h4>
			</td>
		</tr>
	</tbody>
</table>
<br>
<table class="border thick">
	<thead>
		<tr class="border thick">
			<th width="10">NO</th>
			<th align="left"><?= strtoupper($judul['nomor']) ?></th>
			<?php if ($analisis_master['subjek_tipe'] != 4): ?>
				<th align="left"><?= strtoupper($judul['nomor_kk']) ?></th>
			<?php endif;?>
			<th align="left"><?= strtoupper($judul['nama']) ?></th>
			<th align="left">JENIS KELAMIN</th>
			<th align="left">ALAMAT</th>
			<th align="left">NILAI</th>
			<th align="left">KLASIFIKASI</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($main as $key => $data): ?>
			<tr>
				<td align="center" width="2"><?= ($key + 1); ?></td>
				<td class="textx" ><?= $data['uid'] ?></td>
				<?php if ($analisis_master['subjek_tipe'] != 4): ?>
					<td class="textx"><?= $data['kk'] ?></td>
				<?php endif;?>
				<td><?= $data['nama'] ?></td>
				<td align="center"><?= $data['jk'] ?></td>
				<td><?= strtoupper($data['alamat'] . " "  .  "RT/RW ". $data['rt']."/".$data['rw'] . " - " . $this->setting->sebutan_dusun . " " . $data['dusun']) ?></td>
				<td align="right"><?= $data['nilai'] ?></td>
				<td align="right"><?= $data['klasifikasi'] ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
