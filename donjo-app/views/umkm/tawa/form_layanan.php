<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Tambah/Ubah</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('tawa')?>"><i class="fa fa-dashboard"></i> Daftar Transportasi Warga</a></li>
			<li><a href='<?= site_url("tawa/layanan/$album")?>'><i class="fa fa-dashboard"></i> Daftar Layanan</a></li>
			<li class="active">Tambah/Ubah</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
            <div class="box-header with-border">
							<a href="<?= site_url("tawa/layanan/$album")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali</a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="control-label col-sm-4" for="nama">Nama Layanan</label>
								<div class="col-sm-6">
									<input name="nama" class="form-control input-sm nomor_sk required" maxlength="50" type="text" placeholder="Nama Layanan" value="<?=$gallery['nama']?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="nama_pengendara">Nama Pengendara</label>
								<div class="col-sm-6">
									<input name="nama_pengendara" class="form-control input-sm" maxlength="50" type="text" placeholder="Nama Pengendara" value="<?=$gallery['nama_pengendara']?>"></input>
								</div>
							</div>							<div class="form-group">
								<label class="control-label col-sm-4" for="harga">Harga/Biaya</label>
								<div class="col-sm-2">
                                  <select class="form-control input-sm select2 required" id="sebutan_biaya" name="sebutan_biaya" style="width:100%;">
                                    <?php foreach ($sebutan_biaya as $value) : ?>
                                    <option <?= $value === $gallery['sebutan_biaya'] ? 'selected' : '' ?> value="<?= $value ?>">
                                    <?= $value ?>
                                    </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
								<div class="col-sm-2">
									<input name="harga" class="form-control input-sm required" maxlength="20" type="text" placeholder="rupiah" value="<?= $gallery['harga']?>"></input>
								</div> 
								<div class="col-sm-1">
                                  <select class="form-control input-sm select2 required" id="sebutan_ukuran" name="sebutan_ukuran" style="width:100%;">
                                    <?php foreach ($sebutan_ukuran as $value) : ?>
                                    <option <?= $value === $gallery['sebutan_ukuran'] ? 'selected' : '' ?> value="<?= $value ?>">
                                    <?= $value ?>
                                    </option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="diskon">Jenis Kendaraan</label>
								<div class="col-sm-2">
								<select class="form-control input-sm select2 required" id="jenis_kendaraan" name="jenis_kendaraan" style="width:100%;">
                                    <?php foreach ($jenis_kendaraan as $value) : ?>
                                    <option <?= $value === $gallery['jenis_kendaraan'] ? 'selected' : '' ?> value="<?= $value ?>">
                                    <?= $value ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="kapasitas">Kapasitas Muatan</label>
								<div class="col-sm-2">
								<input name="kapasitas" class="form-control input-sm required" maxlength="20" type="text" placeholder="" value="<?= $gallery['kapasitas']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="merek">Merek/Tipe Kendaraan</label>
								<div class="col-sm-2">
								<input name="merek" class="form-control input-sm required" maxlength="20" type="text" placeholder="" value="<?= $gallery['merek']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="jenis_kendaraan">Jenis/Model Kendaraan</label>
								<div class="col-sm-2">
								<input name="jenis_kendaraan" class="form-control input-sm required" maxlength="20" type="text" placeholder="" value="<?= $gallery['jenis_kendaraan']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="tahun_pembuatan">Tahun Pembuatan</label>
								<div class="col-sm-2">
								<input name="tahun_pembuatan" class="form-control input-sm required" maxlength="20" type="text" placeholder="XXXX" value="<?= $gallery['tahun_pembuatan']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="warna_kendaraan">Warna Kendaraan</label>
								<div class="col-sm-2">
								<input name="warna_kendaraan" class="form-control input-sm required" maxlength="20" type="text" placeholder="" value="<?= $gallery['warna_kendaraan']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="warna_plat_nomor">Warna Plat Nomor </label>
								<div class="col-sm-2">
								<input name="warna_plat_nomor" class="form-control input-sm required" maxlength="20" type="text" placeholder="" value="<?= $gallery['warna_plat_nomor']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="isi_silinder">Isi Silinder</label>
								<div class="col-sm-2">
								<input name="isi_silinder" class="form-control input-sm required" maxlength="20" type="text" placeholder="" value="<?= $gallery['isi_silinder']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="bahan_bakar">Bahan Bakar</label>
								<div class="col-sm-2">
								<select class="form-control input-sm select2 required" id="bahan_bakar" name="bahan_bakar" style="width:100%;">
                                    <?php foreach ($bahan_bakar as $value) : ?>
                                    <option <?= $value === $gallery['bahan_bakar'] ? 'selected' : '' ?> value="<?= $value ?>">
                                    <?= $value ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="no_pol">Nomor Polisi</label>
								<div class="col-sm-2">
								<input name="no_pol" class="form-control input-sm required" maxlength="20" type="text" placeholder="Contoh: Z XXXX DA" value="<?= $gallery['no_pol']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="no_bpkb">Nomor BPKB</label>
								<div class="col-sm-2">
								<input name="no_bpkb" class="form-control input-sm required" maxlength="20" type="text" placeholder="Contoh: XXXXXXXX" value="<?= $gallery['no_bpkb']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="no_rangka">Nomor Rangka</label>
								<div class="col-sm-2">
								<input name="no_rangka" class="form-control input-sm required" maxlength="20" type="text" placeholder="Contoh: XXXXXXXX" value="<?= $gallery['no_rangka']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="no_mesin">Nomor Mesin</label>
								<div class="col-sm-2">
								<input name="no_mesin" class="form-control input-sm required" maxlength="20" type="text" placeholder="Contoh: XXXXXX" value="<?= $gallery['no_mesin']?>"></input>								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" style="text-align:left;" for="area">Area Layanan</label>
								<div class="col-sm-3">
									<select class="form-control input-sm select2" id="area" name="area" style="width:100%;">
										<?php foreach ($area as $value) : ?>
											<option <?= $value === $usaha['area'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="deskripsi">Deskripsi</label>
								<div class="col-sm-6">								
								<textarea name="deskripsi" class="form-control input-sm required" style="height:50px;"><?=$gallery['deskripsi']?></textarea>
                                </div>
							</div>
							<?php if ($gallery['gambar']): ?>
								<div class="form-group">
									<label class="control-label col-sm-4" for="nama"></label>
									<div class="col-sm-6">
										<input type="hidden" name="old_gambar" value="<?=  $gallery['gambar']?>">
									  <img class="attachment-img img-responsive img-circle" src="<?= AmbilGaleri($gallery['gambar'], 'sedang') ?>" alt="Gambar Album" width="200px">
									</div>
								</div>
							<?php endif; ?>
							<div class="form-group">
									<label class="control-label col-sm-4" for="upload">Unggah Gambar</label>
									<div class="col-sm-6">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control <?php !($gallery['gambar']) and print('required') ?>" id="file_path">
											<input id="file" type="file" class="hidden" name="gambar">
											<span class="input-group-btn">
												<button type="button" class="btn btn-info btn-box"  id="file_browser"><i class="fa fa-search"></i> Browse</button>
											</span>
										</div>
										<?php $upload_mb = max_upload();?>
										<p><label class="control-label"><code>Unggah Foto Kendaraan bersama Pengendara. Batas maksimal File berkas <strong><?=$upload_mb?> MB.</strong></code></label></p>
									</div>
								</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
								<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' ><i class='fa fa-times'></i> Batal</button>
								<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
