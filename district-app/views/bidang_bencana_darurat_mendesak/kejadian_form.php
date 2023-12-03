<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/localization/messages_id.js"></script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Laporan Kejadian</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bidang_bencana_darurat_mendesak') ?>"> Daftar Laporan Kejadian</a></li>
			<li class="active">Form </li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('bidang_bencana_darurat_mendesak') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Kejadian"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Kejadian</a>
			</div>
			<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">A. KEJADIAN BENCANA</label>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="id_master">Kelompok Bencana</label>
						<div class="col-sm-4">
							<select class="form-control input-sm required" name="kelompok_bencana">
								<option value="">Pilih Kelompok Bencana</option>
								<?php foreach ($list_kelompok_bencana as $key => $value) : ?>
									<?php if (in_array($key, ['1', '2', '3'])) : ?>
										<option value="<?= $key; ?>" <?= selected($laporan_kejadian_bencana['kelompok_bencana'], $key); ?>><?= $value ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jenis_bencana">Jenis Bencana</label>
						<div class="col-sm-8">
							<input name="jenis_bencana" class="form-control input-sm nomor_sk required" maxlength="100" placeholder="Detail jenis bencana" type="text" value="<?= $laporan_kejadian_bencana['jenis_bencana'] ?>"></input>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label" for="tanggal_kejadian">Tanggal & waktu kejadian</label>
						<div class="col-sm-2">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_1" name="tanggal_kejadian" placeholder="Tanggal Kejadian" type="text" value="<?= $laporan_kejadian_bencana['tanggal_kejadian'] ?>">
							</div>
						</div>
						<div class="col-sm-2">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="jam_1" name="waktu_kejadian" placeholder="Waktu Kejadian" type="text" value="<?= $laporan_kejadian_bencana['waktu_kejadian'] ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="lokasi_bencana">Lokasi Bencana</label>
						<div class="col-sm-8">
							<textarea id="lokasi_bencana" name="lokasi_bencana" class="form-control input-sm required" placeholder="Isikan dengan informasi di mana bencana terjadi, Kabupaten/Kota, Kecamatan, Desa/Kelurahan, Daerah Cakupan Bencana" rows="3" value="<?= $laporan_kejadian_bencana['lokasi_bencana'] ?>"><?= $laporan_kejadian_bencana['lokasi_bencana'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="penyebab_bencana">Penyebab Bencana</label>
						<div class="col-sm-8">
							<textarea id="penyebab_bencana" name="penyebab_bencana" class="form-control input-sm required" placeholder="Tuliskan pemicu terjadinya bencana," rows="3" value="<?= $laporan_kejadian_bencana['penyebab_bencana'] ?>"><?= $laporan_kejadian_bencana['penyebab_bencana'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="deskripsi_bencana">Deskripsi Bencana</label>
						<div class="col-sm-8">
							<textarea id="deskripsi_bencana" name="deskripsi_bencana" class="form-control input-sm required" placeholder="Tuliskan gambaran secara keseluruhan " rows="3" value="<?= $laporan_kejadian_bencana['deskripsi_bencana'] ?>"><?= $laporan_kejadian_bencana['deskripsi_bencana'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">B. KORBAN JIWA</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jumlah_korban">Jumlah Korban</label>
						<div class="col-sm-2">
							<input name="jumlah_korban" class="form-control input-sm required angka" maxlength="10" placeholder="diisi angka" type="text" value="<?= $laporan_kejadian_bencana['jumlah_korban'] ?>"></input>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-sm-3" for="korban_meninggal"></label>
						<div class="col-sm-2">
							<small>Meninggal</small><input name="korban_meninggal" class="form-control input-sm required angka" maxlength="5" placeholder="diisi angka" type="text" value="<?= $laporan_kejadian_bencana['korban_meninggal'] ?>"></input>
						</div>
						<div class="col-sm-2">
							<small>Hilang</small><input name="korban_hilang" class="form-control input-sm required angka" maxlength="5" placeholder="diisi angka" type="text" value="<?= $laporan_kejadian_bencana['korban_hilang'] ?>"></input>
						</div>
						<div class="col-sm-2">
							<small>Luka Berat</small><input name="korban_lukaberat" class="form-control input-sm required angka" maxlength="5" placeholder="diisi angka" type="text" value="<?= $laporan_kejadian_bencana['korban_lukaberat'] ?>"></input>
						</div>
						<div class="col-sm-2">
							<small>Luka Ringan</small><input name="korban_lukaringan" class="form-control input-sm required angka" maxlength="5" placeholder="diisi angka" type="text" value="<?= $laporan_kejadian_bencana['korban_lukaringan'] ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="lokasi_pengungsi">Lokasi_pengungsi</label>
						<div class="col-sm-8">
							<input name="lokasi_pengungsi" class="form-control input-sm " maxlength="100" placeholder="Lokasi Pengungsi" type="text" value="<?= $laporan_kejadian_bencana['lokasi_pengungsi'] ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jumlah_pengungsi">Jumlah Pengungsi</label>
						<div class="col-sm-2">
							<input name="jumlah_pengungsi" class="form-control input-sm required angka" maxlength="200" placeholder="diisi angka" type="text" value="<?= $laporan_kejadian_bencana['jumlah_pengungsi'] ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="penderita_terdampak">Penderita/Terdampak</label>
						<div class="col-sm-8">
							<textarea id="penderita_terdampak" name="penderita_terdampak" class="form-control input-sm required" placeholder="Isi dengan jumlah penderita/terdampak, bedakan menurut usia dan jenis kelamin." rows="3"><?= $laporan_kejadian_bencana['penderita_terdampak'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">C. KERUSAKAN</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Kerusakan bangunan</label>
						<div class="col-sm-8">
							<textarea id="kerusakan_bangunan" name="kerusakan_bangunan" class="form-control input-sm required" placeholder="Isi dengan nama Kecamatan, Desa, atau jika memungkinkan hingga tingkat Lingkungan/Dusun, serta jumlah kerusakan untuk tiap jenis bangunan " rows="3"><?= $laporan_kejadian_bencana['kerusakan_bangunan'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_ls">Kerusakan Lintas Sektor</label>
						<div class="col-sm-8">
							<textarea id="kerusakan_ls" name="kerusakan_ls" class="form-control input-sm required" placeholder="Isi dengan nama Kecamatan, jenis kerusakan serta jumlah kerusakan yang dikelompokkan menjadi rusak berat, rusak sedang dan rusak ringan, serta total kerusakan keseluruhan beserta satuannya" rows="3"><?= $laporan_kejadian_bencana['kerusakan_ls'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">D. FASILITAS UMUM YANG MASIH BISA DIGUNAKAN</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="akses_ke_lokasi">Akses ke lokasi bencana</label>
						<div class="col-sm-8">
							<textarea id="akses_ke_lokasi" name="akses_ke_lokasi" class="form-control input-sm required" placeholder="Tuliskan bagaimana akses ke lokasi bencana" rows="3"><?= $laporan_kejadian_bencana['akses_ke_lokasi'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="sarana_transportasi">Sarana transportasi (angkutan umum, ketersediaan BBM)</label>
						<div class="col-sm-8">
							<textarea id="sarana_transportasi" name="sarana_transportasi" class="form-control input-sm required" placeholder="Tuliskan sumber daya apa saja yang dapat dimanfaatkan" rows="3"><?= $laporan_kejadian_bencana['sarana_transportasi'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jalur_komunikasi">Jalur komunikasi (seluler, telepon, radio komunikasi)</label>
						<div class="col-sm-8">
							<textarea id="jalur_komunikasi" name="jalur_komunikasi" class="form-control input-sm required" placeholder="Tuliskan kondisi jalur komunikasi" rows="3"><?= $laporan_kejadian_bencana['jalur_komunikasi'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jaringan_listrik">Keadaan jaringan listrik</label>
						<div class="col-sm-8">
							<textarea id="jaringan_listrik" name="jaringan_listrik" class="form-control input-sm required" placeholder="Tuliskan kondisi jaringan listrik" rows="3"><?= $laporan_kejadian_bencana['jaringan_listrik'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jaringan_air_bersih">Keadaan jaringan air/air bersih </label>
						<div class="col-sm-8">
							<textarea id="jaringan_air_bersih" name="jaringan_air_bersih" class="form-control input-sm required" placeholder="Tuliskan kondisi jaringan air bersih" rows="3"><?= $laporan_kejadian_bencana['jaringan_air_bersih'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="fasilitas_kesehatan">Fasilitas kesehatan (RS, Puskesmas, Pustu)</label>
						<div class="col-sm-8">
							<textarea id="fasilitas_kesehatan" name="fasilitas_kesehatan" class="form-control input-sm required" placeholder="Tuliskan kondisi Fasilitas Kesehatan" rows="3"><?= $laporan_kejadian_bencana['fasilitas_kesehatan'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">E. UPAYA PENANGANAN</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="upaya_penanganan">Upaya Penanganan Darurat Yang Telah Dilakukan</label>
						<div class="col-sm-8">
							<textarea id="upaya_penanganan" name="upaya_penanganan" class="form-control input-sm required" placeholder="Tuliskan upaya apa saja yang sudah dilakukan" rows="3"><?= $laporan_kejadian_bencana['upaya_penanganan'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">F. SUMBER DAYA </label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="sumberdaya">Sumber Daya yang masih bisa dimanfaatkan</label>
						<div class="col-sm-8">
							<textarea id="sumberdaya" name="sumberdaya" class="form-control input-sm required" placeholder="Tuliskan sumber daya apa saja yang dapat dimanfaatkan" rows="3"><?= $laporan_kejadian_bencana['sumberdaya'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">F. Relawan yang dimobilisasi</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="mobilisasi_relawan">Relawan yang dimobilisasi</label>
						<div class="col-sm-8">
							<textarea id="mobilisasi_relawan" name="mobilisasi_relawan" class="form-control input-sm required" placeholder="Tuliskan relawan dari mana saja yang turut membantu, nasional & internasional" rows="3"><?= $laporan_kejadian_bencana['mobilisasi_relawan'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">G. Penerimaan Bantuan </label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="bantuan_dn">Bantuan Dalam Negeri</label>
						<div class="col-sm-8">
							<textarea id="bantuan_dn" name="bantuan_dn" class="form-control input-sm required" placeholder="Tuliskan Bantuan Dalam Negeri yang diterima, tanggal, jenis, jumlah, satuan & nilai" rows="3"><?= $laporan_kejadian_bencana['bantuan_dn'] ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="bantuan_ln">Bantuan Luar Negeri</label>
						<div class="col-sm-8">
							<textarea id="bantuan_ln" name="bantuan_ln" class="form-control input-sm required" placeholder="Tuliskan Bantuan Luar Negeri yang diterima, tanggal, jenis, jumlah, satuan & nilai" rows="3"><?= $laporan_kejadian_bencana['bantuan_ln'] ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">H. Potensi Bencana Susulan</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="potensi_bencana_susulan">Potensi Bencana Susulan</label>
						<div class="col-sm-8">
							<input name="potensi_bencana_susulan" class="form-control input-sm required" maxlength="200" placeholder="Kerusakan Bangunan" type="text" value="<?= $laporan_kejadian_bencana['potensi_bencana_susulan'] ?>"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">I. Identitas Pelapor</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="nama_pelapor">Nama Lengkap</label>
						<div class="col-sm-8">
							<input name="nama_pelapor" class="form-control input-sm required" maxlength="200" placeholder="Nama lengkap" type="text" value="<?= $laporan_kejadian_bencana['nama_pelapor'] ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="alamat_pelapor">Alamat</label>
						<div class="col-sm-8">
							<input name="alamat_pelapor" class="form-control input-sm required" maxlength="200" placeholder="Alamat" type="text" value="<?= $laporan_kejadian_bencana['alamat_pelapor'] ?>"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="nomor_pelapor">Nomor Telepon</label>
						<div class="col-sm-8">
							<input name="nomor_pelapor" class="form-control input-sm required" maxlength="200" placeholder="Nomor telepon" type="text" value="<?= $laporan_kejadian_bencana['nomor_pelapor'] ?>"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Foto Kejadian Bencana</label>
						<div class="col-sm-4">
							<div class="input-group input-group-sm ">
								<input type="text" class="form-control" id="file_path">
								<input type="file" class="hidden" id="file" name="foto">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-box" id="file_browser" value="<?= $laporan_kejadian_bencana['foto'] ?>"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
							<span class="help-block"><code> Kosongkan jika tidak ingin mengunggah gambar</code></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tanggal_tutup_laporan">Akhir Pelaporan</label>
						<div class="col-sm-3">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_2" name="tanggal_tutup_laporan" placeholder="Tgl. Akhir" type="text" value="<?= $laporan_kejadian_bencana['tanggal_tutup_laporan'] ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="status">Status</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="status" id="status" value="<?= $laporan_kejadian_bencana['status'] ?>">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
								<!-- Default Value Aktif -->
							</select>
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<button type='reset' class='btn btn-social btn-box btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
					<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
				</div>
			</form>
		</div>
	</section>
</div>