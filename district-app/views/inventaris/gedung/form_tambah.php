<div class="content-wrapper">
	<section class="content-header">
		<h1>Isi Data Inventaris Gedung Dan Bangunan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url() ?>inventaris_gedung"><i class="fa fa-dashboard"></i>Daftar Inventaris Gedung Dan Bangunan</a></li>
			<li class="active">Isi Data</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form class="form-horizontal" id="validasi" name="form_gedung" method="post" action="<?= site_url("api_inventaris_gedung/add"); ?>">
			<div class="row">
				<div class="col-md-3">
					<?php $this->load->view('inventaris/menu_kiri.php')?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url() ?>inventaris_gedung" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Inventaris Gedung Dan Bangunan</a>
						</div>
						<?php
							$reg = $count_reg->count + 1;
							$jumlah_kata = strlen($reg);
							$hasil = sprintf("%06s",$reg);
						?>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="nama_barang">Nama Barang / Jenis Barang</label>
										<div class="col-sm-8">
											<input type="hidden" name="nama_barang_save" id="nama_barang_save">
											<input type="hidden" name="kode_desa" id="kode_desa" value="<?=kode_wilayah($get_kode["kode_desa"])?>">
											<select class="form-control input-sm select2" id="nama_barang" name="nama_barang" onchange="formAction('main')">
												<?php foreach ($aset as $data): ?>
													<option value="<?=  $data['nama']."_".$data['golongan'].".".$data['bidang'].".".$data['kelompok'].".".$data['sub_kelompok'].".".$data['sub_sub_kelompok'].".".$hasil?>">Kode Reg : <?= $data['golongan'].".".$data['bidang'].".".$data['kelompok'].".".$data['sub_kelompok'].".".$data['sub_sub_kelompok']." - ".$data['nama']?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kode_barang">Kode Barang</label>
										<div class="col-sm-8">
											<input maxlength="50" class="form-control input-sm required" name="kode_barang" id="kode_barang" type="text"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="register">Nomor Register</label>
										<div class="col-sm-8">
											<input maxlength="50" class="form-control input-sm required" name="register" id="register" type="text"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kondisi">Kondisi Bangunan</label>
										<div class="col-sm-4">
											<select name="kondisi" id="kondisi" class="form-control input-sm required">
												<option value="">-- Pilih Kondisi --</option>
												<option value="Baik">Baik</option>
												<option value="Rusak Ringan">Rusak Ringan</option>
												<option value="Rusak Sedang">Rusak Sedang</option>
												<option value="Rusak Berat">Rusak Berat</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="tingkat">Bangunan Bertingkat</label>
										<div class="col-sm-4">
											<div class="input-group">
												<input class="form-control input-sm number required" id="tingkat" name="tingkat" type="text"/>
												<span class="input-group-addon input-sm" id="koefisien_dasar_bangunan-addon">Lantai</span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kontruksi">Kontruksi Beton</label>
										<div class="col-sm-4">
											<select name="kontruksi" id="kontruksi" class="form-control input-sm required">
												<option value="0">Tidak</option>
												<option value="1">Ya</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="luas">Luas Bangunan</label>
										<div class="col-sm-4">
											<div class="input-group">
												<input class="form-control input-sm number required" id="luas_bangunan" name="luas_bangunan" type="text"/>
												<span class="input-group-addon input-sm" id="koefisien_dasar_bangunan-addon">M<sup>2</sup></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="alamat">Letak / Lokasi </label>
										<div class="col-sm-8">
											<textarea class="form-control input-sm required" name="alamat" id="alamat"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="tahun">Tahun Pengadaan </label>
										<div class="col-sm-4">
											<select name="tahun_pengadaan" id="tahun_pengadaan" class="form-control input-sm select2 required datatable" style="width:100%;" placeholder="Tahun Pengadaan">
												<?php for ($i=date("Y"); $i>=1900; $i--): ?>
													<option value="<?= $i ?>"><?= $i ?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="no_bangunan">Nomor Bangunan</label>
										<div class="col-sm-8">
											<input maxlength="50" class="form-control input-sm required" name="no_bangunan" id="no_bangunan" type="text"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="tanggal_bangunan">Tanggal Dokumen Bangunan</label>
										<div class="col-sm-4">
											<input maxlength="50" class="form-control input-sm required" name="tanggal_bangunan" id="tanggal_bangunan" type="date"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="status_tanah">Status Tanah</label>
										<div class="col-sm-8">
											<select name="status_tanah" id="status_tanah" class="form-control input-sm required">
												<option value="">-- Pilih Status Tanah --</option>
												<option value="Tanah milik Pemda">Tanah milik Pemda</option>
												<option value="Tanah Negara">Tanah Negara (Tanah yang dikuasai langsung oleh Negara)</option>
												<option value="Tanah Hak Ulayat">Tanah Hak Ulayat (Tanah masyarakat Hukum Adat)</option>
												<option value="Tanah Hak">Tanah Hak (Tanah kepunyaan perorangan atau Badan Hukum)</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="luas_tanah">Luas Tanah </label>
										<div class="col-sm-4">
											<div class="input-group">
												<input class="form-control input-sm number required" id="luas_tanah" name="luas_tanah" type="text"/>
												<span class="input-group-addon input-sm" id="koefisien_dasar_bangunan-addon">M<sup>2</sup></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kode_tanah">Nomor Kode Tanah</label>
										<div class="col-sm-8">
											<input maxlength="50" class="form-control input-sm required" name="kode_tanah" id="kode_tanah" type="text"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label required" style="text-align:left;" for="hak_tanah">Penggunaan Barang </label>
										<div class="col-sm-4">
											<select name="penggunaan_barang" id="penggunaan_barang" class="form-control input-sm required" placeholder="Hak Tanah">
												<option value="01">Pemerintah Desa</option>
												<option value="02">Badan Permusyawaratan Daerah</option>
												<option value="03">PKK</option>
												<option value="04">LKMD</option>
												<option value="05">Karang Taruna</option>
												<option value="06">RW</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="asal_usul">Asal Usul </label>
										<div class="col-sm-4">
											<select name="asal" id="asal" class="form-control input-sm required">
												<option value="">-- Pilih Asal Usul Lahan --</option>
												<option value="Bantuan Kabupaten">Bantuan Kabupaten</option>
												<option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
												<option value="Bantuan Provinsi">Bantuan Provinsi</option>
												<option value="Pembelian Sendiri">Pembelian Sendiri</option>
												<option value="Sumbangan">Sumbangan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="harga">Harga</label>
										<div class="col-sm-4">
											<div class="input-group">
												<span class="input-group-addon input-sm" id="koefisien_dasar_bangunan-addon">Rp</span>
												<input onkeyup="price()" class="form-control input-sm numberrequired" id="harga" name="harga" type="text"/>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="input-group">
												<input type="text" class="form-control input-sm required" id="output" name="output" placeholder="" disabled/>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="keterangan">Keterangan</label>
										<div class="col-sm-8">
											<textarea rows="5" class="form-control input-sm required" name="keterangan" id="keterangan" ></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="col-xs-12">
								<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
								<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>

<script>
	$( document ).ready(function() {
		$('#kode_barang').val($('#kode_desa').val()+"."+$('#penggunaan_barang').val()+"."+$('#tahun_pengadaan').val());

		$("#tahun_pengadaan").change(function() {
			$('#kode_barang').val($('#kode_desa').val()+"."+$('#penggunaan_barang').val()+"."+$('#tahun_pengadaan').val());
		});

		$("#penggunaan_barang").change(function() {
			$('#kode_barang').val($('#kode_desa').val()+"."+$('#penggunaan_barang').val()+"."+$('#tahun_pengadaan').val());
		});

		$("#nama_barang").change(function() {
			$('#register').val($('#nama_barang').val().split("_").pop());
			$('#nama_barang_save').val($('#nama_barang').val().slice(0,-22));
		});

		$("#tahun_pengadaan").change();
		$("#penggunaan_barang").change();
		$("#nama_barang").change();
	});

	function price() {
		$('#output').val(numeral($('#harga').val()).format('Rp0,0'));
	}

	$(function() {
		$('.select2').select2();
	})
</script>
