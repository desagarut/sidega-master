<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/localization/messages_id.js"></script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Detail Laporan Kejadian</h1>
		<ol class="breadcrumb">
			<tr><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></tr>
			<tr><a href="<?= site_url('bidang_bencana_darurat_mendesak') ?>"> Daftar Laporan Kejadian</a></tr>
			<li class="active">Detail </tr>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('bidang_bencana_darurat_mendesak') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Kejadian"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Kejadian</a>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
					</div>
					<div class="col-md-6">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table style="padding-left: 10px">
							<tdead>
								<h5>A. KEJADIAN BENCANA</h5>
								</thead>
								<tbody style="font-size:12px; padding-left: 5px">
									<tr>
										<td width='29%'>Kelompok Bencana</td>
										<td width='1%'>:</td>
										<td width='70%'><?= strtoupper($list_kelompok_bencana[$laporan_kejadian_bencana["kelompok_bencana"]]) ?></td>
									</tr>
									<tr>
										<td>Jenis Bencana</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['jenis_bencana'] ?></td>
									</tr>
									<tr>
										<td>Tanggal & waktu kejadian</td>
										<td>:</td>
										<td><?= tgl_indo_out($laporan_kejadian_bencana['tanggal_kejadian']) ?> - jam <?= $laporan_kejadian_bencana['waktu_kejadian'] ?></td>
									</tr>
									<tr>
										<td>Lokasi Bencana</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['lokasi_bencana'] ?></td>
									</tr>
									<tr>
										<td>Penyebab Bencana</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['penyebab_bencana'] ?></td>
									</tr>
									<tr>
										<td>Deskripsi Bencana</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['deskripsi_bencana'] ?></td>
									</tr>
									<tr>
										<td>Foto Kejadian</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['foto_kejadian'] ?></td>
									</tr>

								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>B. KORBAN JIWA</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Jumlah Korban</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['jumlah_korban'] ?> orang</td>
									</tr>
									<tr>
										<td>Meninggal</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['korban_meninggal'] ?> orang</td>
									</tr>
									<tr>
										<td>Hilang</td>
										<td>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['korban_hilang'] ?> orang</td>
									</tr>
									<tr>
										<td>Luka Berat</td>
										<td>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['korban_lukaberat'] ?> orang</td>
									</tr>
									<tr>
										<td>Luka Ringan</td>
										<td>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['korban_lukaringan'] ?> orang</td>
									</tr>
									<tr>
										<td>Lokasi Pengungsi</td>
										<td>:</td>
										<td><?= $laporan_kejadian_bencana['lokasi_pengungsi'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Jumlah Pengungsi</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['jumlah_pengungsi'] ?> orang</td>
									</tr>
									<tr>
										<td width='29%'>Penderita Terdampak</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['penderita_terdampak'] ?> orang</td>
									</tr>

								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>C. KERUSAKAN</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Kerusakan bangunan</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['kerusakan_bangunan'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Kerusakan Lintas Sektor</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['kerusakan_ls'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>D. FASILITAS UMUM YANG MASIH BISA DIGUNAKAN</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Akses ke lokasi bencana</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['akses_ke_lokasi'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Sarana Transportasi (angkutan umum, ketersediaan BBM)</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['sarana_transportasi'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Jalur komunikasi (seluler, telepon, radio komunikasi)</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['jalur_komunikasi'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Keadaan jaringan listrik</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['jaringan_listrik'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Keadaan jaringan air/air bersih</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['jaringan_air_bersih'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Fasilitas kesehatan (RS, Puskesmas, Pustu)</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['fasilitas_kesehatan'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>F. SUMBER DAYA</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Sumber Daya yang masih bisa dimanfaatkan</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['sumberdaya'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>G. RELAWAN YANG DIMOBILISASI</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Relawan yang dimobilisasi</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['mobilisasi_relawan'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>H. PENERIMAAN BANTUAN</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Bantuan Dalam Negeri</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['bantuan_dn'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Bantuan Luar Negeri</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['bantuan_ln'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>I. POTENSI BENCANA SUSULAN</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Potensi Bencana Susulan</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['potensi_bencana_susulan'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>J. IDENTITAS PELAPOR</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Nama Lengkap</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['nama_pelapor'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Alamat Lengkap</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['alamat_pelapor'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Nomor Telepon</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['nomor_pelapor'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table>
							<tdead>
								<h5>PELAPORAN</h5>
								</thead>
								<tbody style="font-size:12px">
									<tr>
										<td width='29%'>Status</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['status'] ?></td>
									</tr>
									<tr>
										<td width='29%'>Tanggal akhir Pelaporan</td>
										<td width='1%'>:</td>
										<td width='70%'><?= $laporan_kejadian_bencana['tanggal_tutup_laporan'] ?></td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class='box-footer'>
			</div>
		</div>
	</section>
</div>