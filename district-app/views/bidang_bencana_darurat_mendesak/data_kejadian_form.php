<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/localization/messages_id.js"></script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Tambah Laporan Kejadian</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bidang_bencana_darurat_mendesak') ?>"> Daftar Laporan Kejadian</a></li>
			<li class="active">Tambah </li>
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
					<?php $kelompok_bencana = @$_REQUEST["kelompok_bencana"]; ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Kelompok Bencana</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="kelompok_bencana" id="kelompok_bencana">
								<option value="">Pilih Kelompok Bencana</option>
								<option value="1" <?php selected($kelompok_bencana, 1); ?>>Bencana Alam</option>
								<option value="2" <?php selected($kelompok_bencana, 2); ?>>Bencana Non Alam</option>
								<option value="3" <?php selected($kelompok_bencana, 3); ?>>Bencana Sosial</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jenis_bencana">Jenis Bencana</label>
						<div class="col-sm-8">
							<input name="jenis_bencana" class="form-control input-sm nomor_sk required" maxlength="100" placeholder="Detail jenis bencana" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tgl_post">Tanggal kejadian</label>
						<div class="col-sm-3">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_1" name="sdate" placeholder="Tanggal Kejadian" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tgl_post">Waktu kejadian</label>
						<div class="col-sm-3">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="jam_1" name="sdate" placeholder="Waktu Kejadian" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="lokasi_bencana">Lokasi Bencana</label>
						<div class="col-sm-8">
							<textarea id="lokasi_bencana" name="lokasi_bencana" class="form-control input-sm required" placeholder="Isikan dengan informasi di mana bencana terjadi, Kabupaten/Kota, Kecamatan, Desa/Kelurahan, Daerah Cakupan Bencana" rows="3"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="penyebab_bencana">Penyebab Bencana</label>
						<div class="col-sm-8">
							<textarea id="penyebab_bencana" name="penyebab_bencana" class="form-control input-sm required" placeholder="Tuliskan pemicu terjadinya bencana," rows="3"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="penyebab_bencana">Deskripsi Bencana</label>
						<div class="col-sm-8">
							<textarea id="penyebab_bencana" name="penyebab_bencana" class="form-control input-sm required" placeholder="Tuliskan gambaran secara keseluruhan " rows="3"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">B. KORBAN JIWA</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jumlah_korban">Jumlah Korban</label>
						<div class="col-sm-3">
							<input name="jumlah_korban" class="form-control input-sm required" maxlength="10" placeholder="Jumlah Korban" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="korban_meninggal">Korban Meninggal</label>
						<div class="col-sm-3">
							<input name="korban_meninggal" class="form-control input-sm required" maxlength="10" placeholder="Jumlah Korban Meninggal" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="korban_hilang">Korban Hilang</label>
						<div class="col-sm-3">
							<input name="korban_hilang" class="form-control input-sm required" maxlength="10" placeholder="Jumlah Korban Hilang" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="korban_lukaberat">Korban Luka Berat</label>
						<div class="col-sm-3">
							<input name="korban_lukaberat" class="form-control input-sm required" maxlength="10" placeholder="Jumlah Korban Luka Berat" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="korban_lukaringan">Korban Luka Ringan</label>
						<div class="col-sm-3">
							<input name="korban_lukaringan" class="form-control input-sm required" maxlength="10" placeholder="Jumlah Korban Luka Ringan" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="lokasi_pengungsi">Lokasi_pengungsi</label>
						<div class="col-sm-8">
							<input name="lokasi_pengungsi" class="form-control input-sm required" maxlength="100" placeholder="Lokasi Pengungsi" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jumlah_pengungsi">Jumlah Pengungsi</label>
						<div class="col-sm-3">
							<input name="jumlah_pengungsi" class="form-control input-sm required" maxlength="10" placeholder="Jumlah Pengungsi" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="penderita_terdampak">Penderita/Terdampak</label>
						<div class="col-sm-8">
							<textarea id="penderita_terdampak" name="penderita_terdampak" class="form-control input-sm required" placeholder="Tuliskan pemicu terjadinya bencana," rows="3"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">C. KERUSAKAN</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Kerusakan bangunan</label>
						<div class="col-sm-3">
							<input name="kerusakan_bangunan" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Bangunan" type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_ls">Kerusakan Lintas Sektor</label>
						<div class="col-sm-3">
							<input name="kerusakan_ls" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Lintas Sektor" type="text"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">D. Upaya Penanganan </label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Upaya Penanganan Darurat Yang Telah Dilakukan</label>
						<div class="col-sm-3">
							<input name="kerusakan_bangunan" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Bangunan" type="text"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">E. Sumber Daya </label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Sumber Daya yang masih bisa dimanfaatkan</label>
						<div class="col-sm-3">
							<input name="kerusakan_bangunan" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Bangunan" type="text"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">F. Relawan yang dimobilisasi</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Relawan yang dimobilisasi</label>
						<div class="col-sm-3">
							<input name="kerusakan_bangunan" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Bangunan" type="text"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">G. Penerimaan Bantuan </label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Sumber Daya yang masih bisa dimanfaatkan</label>
						<div class="col-sm-3">
							<input name="kerusakan_bangunan" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Bangunan" type="text"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">H. Potensi Bencana Susulan</label>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="kerusakan_bangunan">Potensi Bencana Susulan</label>
						<div class="col-sm-3">
							<input name="kerusakan_bangunan" class="form-control input-sm required" maxlength="10" placeholder="Kerusakan Bangunan" type="text"></input>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="tgl_post">Rentang Waktu Kejadian</label>
						<div class="col-sm-4">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_1" name="sdate" placeholder="Tgl. Mulai" type="text">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_2" name="edate" placeholder="Tgl. Akhir" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="status">Status</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="status" id="status">
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