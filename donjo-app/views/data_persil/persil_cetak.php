<?php
/**
 * File ini:.
 *
 * Laporan daftar Persil
 *
 * sikelu-app/views/data_persil/persil_cetak.php
 */

/*
 *
 * File ini bagian dari:
 *
 * SIKelu
 *
 * Sistem informasi kelurahan sumber terbuka untuk memajukan kelurahan
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:

 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.

 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package SIKelu
 * @author  Tim Pengembang DesaGarut
 * @copyright Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright Hak Cipta 2016 - 2020 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license http://www.gnu.org/licenses/gpl.html  GPL V3
 * @link  https://github.com/SIKelu/SIKelu
 */
?>

<table>
	<tbody>
		<tr>
			<td>
				<?php if ($aksi != 'unduh'): ?>
					<img class="logo" src="<?= gambar_deskel($config['logo']); ?>" alt="logo-kelurahan">
				<?php endif; ?>
				<h1 class="judul">
					PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' . $this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_deskel . ' ' . $config['nama_deskel']); ?>
				</h1>
			</td>
		</tr>
		<tr>
			<td><hr class="garis"></td>
		</tr>
		<tr>
			<td class="text-center">
				<h4><u> DATA PERSIL </u></h4>
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
							<th>No. Persil : No. Urut Bidang</th>
							<th>Kelas Tanah</th>
							<th>Luas (M2)</th>
							<th>Lokasi</th>
							<th>Letter-C Awal</th>
							<th>Jml Mutasi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($persil as $item): ?>
						<tr>
							<td ><?= $item['no']?></td>
							<td class="textx"><?= $item['nomor'].' : '.$item['nomor_urut_bidang']?></td>
							<td><?= $persil_kelas[$item["kelas"]]['kode']?></td>
							<td><?= $item['luas_persil']?></td>
							<td><?= $item['alamat'] ?: $item['lokasi']?></td>
							<td><?= $item['nomor_letterc_awal']?></td>
							<td><?= $item['jml_bidang']?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>