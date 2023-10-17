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
				<h4>B4. BUKU PENDUDUK SEMENTARA</h4>
			</td>
		</tr>
		<tr>
			<td class="text-center">
				<h4>BUKU PENDUDUK SEMENTARA BULAN <?= strtoupper(getBulan($bulan)) ?> TAHUN <?= $tahun ?></h4>
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
							<th rowspan="2">NOMOR URUT</th>
							<th rowspan="2">NAMA LENGKAP</th>
							<th colspan="2">JENIS KELAMIN</th>
							<th rowspan="2">NOMOR IDENTITAS / TANDA PENGENAL</th>
							<th rowspan="2">TEMPAT DAN TANGGAL LAHIR / UMUR</th>
							<th rowspan="2">PEKERJAAN</th>
							<th colspan="2">KEWARGANEGARAAN</th>
							<th rowspan="2">DATANG DARI</th>
							<th rowspan="2">MAKSUD DAN TUJUAN KEDATANGAN</th>
							<th rowspan="2">NAMA DAN ALAMAT YG DIDATANGI</th>
							<th rowspan="2">DATANG TANGGAL</th>
							<th rowspan="2">PERGI TANGGAL</th>
							<th rowspan="2">KET</th>
						</tr>
						<tr class="border thick">
							<th>L</th>
							<th>P</th>
							<th>KEBANGSAAN</th>
							<th>KETURUNAN</th>
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
							<th>9</th>
							<th>10</th>
							<th>11</th>
							<th>12</th>
							<th>13</th>
							<th>14</th>
							<th>15</th>
						</tr>
					</thead>
					<tbody>
						<!-- 
							""" 
							Menunggu detil informasi data tiap attributnya sudah atau belum, 
							jika sudah ada bagaimana proses menuju flow tersebut 
							""" 
						-->
						
					<?php if($main): ?>
						<?php foreach ($main as $data): ?>
						<tr>
							<td class="padat"><?= $data['no'] ?></td>
							<td><?= strtoupper($data['nama'])?></td>
							<td class="padat"><?= (strtoupper($data['sex']) == 'LAKI-LAKI') ? "L" : "" ?></td>
							<td class="padat"><?= (strtoupper($data['sex']) == 'PEREMPUAN') ? "P" : "" ?></td>
							<td><?= $privasi_nik ? sensor_nik_kk($data['nik']) : ($aksi == 'unduh' ? $data['nik'].'&nbsp' : $data['nik'])?></td>
							<td><?= $data['tempatlahir'] . ", " . tgl_indo_out($data['tanggallahir']) ?></td>
							<td><?= ($data['pekerjaan'] == 'BELUM/TIDAK BEKERJA') ? "-" : $data['pekerjaan'] ?></td>
							<td><?= $data['warganegara']?></td>
							<td><?= empty($data['negara_asal']) ? "-" : $data['negara_asal'] ?></td>
							<td><?= empty($data['alamat_sebelumnya']) ? "-" : $data['alamat_sebelumnya'] ?></td>
							<td><?= empty($data['maksud_tujuan_kedatangan']) ? "-" : $data['maksud_tujuan_kedatangan'] ?></td>
							<td><?= strtoupper($data['alamat']." RT ".$data['rt']." / RW ".$data['rw']." ".$this->setting->sebutan_dusun." ".$data['dusun'])?></td>
							<td><?= empty($data['tanggal_datang']) ? "-" : tgl_indo_out($data['tanggal_datang']) ?></td>
							<td><?= empty($data['tanggal_pergi']) ? "-" : tgl_indo_out($data['tanggal_pergi']) ?></td>
							<td><?= empty($data['ket']) ? "-" : $data['ket'] ?></td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>