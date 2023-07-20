<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Tambah/Ubah</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('toko_warga')?>"><i class="fa fa-dashboard"></i> Daftar Toko</a></li>
			<li class="active">Tambah/Ubah</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url('toko_warga') ?>" class="btn btn-social btn-flat btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Toko Warga</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
                                    <!-- Start Info Pedagang -->
										<label class="col-sm-3 control-label" style="text-align:left; color:#999">INFO PEDAGANG</label>
                                    </div>
                                    <div class="form-group" >
                                        <label class="col-sm-3 control-label "  for="nama_pengelola">Nama | NIK </label>
                                        <div class="col-sm-3">
                                            <input maxlength="50" class="form-control input-sm nomor_sk required" name="nama_pengelola" id="nama_pengelola" value="<?=$toko['nama_pengelola']?>" type="text" placeholder="Nama pengelola" />
                                        </div>
                                        <div class="col-sm-2">
                                            <input maxlength="50" class="form-control input-sm " name="nik" id="nik" value="<?= $toko['nik'] ?>" type="text" placeholder="NIK" />
                                        </div>
                                        <div class="col-sm-2">
                                            <input maxlength="50" class="form-control input-sm required" name="no_hp" id="no_hp" value="<?= $toko['no_hp'] ?>" type="text" placeholder="Contoh: 82317883161" />
                                        </div>
                                    </div>                                
                                
                                    <div class="form-group" >
                                        <label class="col-sm-3 control-label "  for="alamat_tinggal">Alamat Tempat Tinggal</label>
                                        <div class="col-sm-7">
											<textarea rows="3" class="form-control input-sm required" name="alamat_tinggal" id="alamat_tinggal" placeholder="Alamat Tempat Tinggal"><?= $toko['alamat_tinggal']?></textarea>
                                        </div>
                                    </div>  
                                    <!-- End Info Pedagang -->
                                    
                                    <!-- Start Info Usaha -->
                                                                  
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left; color:#999">INFO USAHA</label>
                                    </div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="nama">Nama Toko</label>
								<div class="col-sm-7">
									<input name="nama" class="form-control input-sm nomor_sk required" maxlength="50" type="text" value="<?=$toko['nama']?>"></input>
								</div>
							</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Nomor Telepon</label>
                                        <div class="col-sm-2">
                                            <input maxlength="50" class="form-control input-sm required" name="no_hp_toko" id="no_hp_toko" value="<?=$toko['no_hp_toko']?>" type="text" placeholder="Contoh: 82317883161" />
                                        </div>
									</div>
                                    
                                    <div class="form-group">
                                        <label for="nama_toko" class="col-sm-3 control-label">Tahun Berdiri</label>
                                            <div class="col-sm-2">
                                                <select class="form-control input-sm select2 required" id="tahun_berdiri" name="tahun_berdiri" style="width:100%;">
                                                    <?php for ($i = date('Y'); $i >= 1999; $i--) : ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                                <script>
                                                    $('#tahun_berdiri').val("<?= $toko['tahun_berdiri']?>");
                                                </script>
                                            </div>
                                    </div> 
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kepemilikan_tempat_usaha">Kepemilikan Tempat Usaha</label>
										<div class="col-sm-7">
											<select class="form-control input-sm select2 required" id="kepemilikan_tempat_usaha" name="kepemilikan_tempat_usaha" style="width:100%;">
												<?php foreach ($kepemilikan_tempat_usaha as $value) : ?>
													<option <?= $value === $toko['kepemilikan_tempat_usaha'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Jumlah Karyawan</label>
										<div class="col-sm-2">
											<input maxlength="50" class="form-control input-sm required" name="jumlah_karyawan" id="jumlah_karyawan" value="<?= $toko['jumlah_karyawan']?>" type="text" placeholder="Jumlah Karyawan" />
										</div>
									</div>
									<div class="form-group">
										<label for="lokasi" class="col-sm-3 control-label">Lokasi Usaha</label>
										<div class="col-sm-7">
                                        <input maxlength="200" class="form-control input-sm required" name="lokasi" id="jumlah_karyawan" value="<?= $toko['lokasi']?>" type="text" placeholder="Lokasi Tempat Usaha" />										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="keterangan_lokasi">Keterangan Lokasi Usaha</label>
										<div class="col-sm-7">
											<textarea rows="5" class="form-control input-sm required" name="keterangan_lokasi" id="keterangan_lokasi" placeholder="Keterangan lengkap lokasi usaha, seperti patokan"><?= $toko['keterangan_lokasi']?></textarea>
										</div>
									</div>
									<?php if ($toko['gambar']): ?>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="nama"></label>
                                            <div class="col-sm-7">
                                                <input type="hidden" name="old_gambar" value="<?=  $toko['gambar']?>">
                                              <img class="attachment-img img-responsive img-circle" width="200px" height="200px" src="<?= AmbilGaleri($toko['gambar'], 'sedang') ?>" alt="Gambar Album">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="upload">Unggah Gambar</label>
                                        <div class="col-sm-7">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control <?php !($toko['gambar']) and print('') ?>" id="file_path">
                                                <input id="file" type="file" class="hidden" name="gambar">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-box"  id="file_browser"><i class="fa fa-search"></i> Browse</button>
                                                </span>
                                            </div>
                                            <?php $upload_mb = max_upload();?>
                                            <p><label class="control-label">Batas maksimal pengunggahan berkas <strong><?=$upload_mb?> MB.</strong></label><br/>
                                            <span class="help-block"><code>(Kosongkan jika tidak ingin mengubah foto)</code></span></p>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="sumber_dana">Sumber Modal</label>
										<div class="col-sm-5">
											<select class="form-control input-sm select2" id="sumber_modal" name="sumber_modal" style="width:100%;">
												<?php foreach ($sumber_modal as $value) : ?>
													<option <?= $value === $toko['sumber_modal'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Taksiran Modal/Aset</label>
										<div class="col-sm-2">
											<input class="form-control input-sm required" name="taksiran_modal" id="taksiran_modal" value="<?= $rupiah($toko['taksiran_modal']) ?>" type="text" placeholder="Taksiran Modal" />
										</div>
									</div>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Taksiran Omset</label>
										<div class="col-sm-2">
											<input maxlength="50" class="form-control input-sm required" name="taksiran_omset" id="taksiran_omset" value="<?= $rupiah($toko['taksiran_omset']) ?>" type="text" placeholder="Taksiran Omset" />
										</div>
									</div>
                                    <!-- End Info Usaha -->
                                    
                                    <!-- Start Klasifikasi Usaha -->
                                                                        
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left; color:#999">KLASIFIKASI USAHA</label>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kelompok_usaha">Kelompok Usaha</label>
										<div class="col-sm-5">
											<select class="form-control input-sm select2 required" id="kelompok_usaha_perdagangan" name="kelompok_usaha_perdagangan" style="width:100%;">
												<?php foreach ($kelompok_usaha_perdagangan as $value) : ?>
													<option <?= $value === $toko['kelompok_usaha_perdagangan'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
                                            <a href="<?=site_url("toko_warga/panduan")?>" title="" class="btn" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Panduan"><i class="fa fa-info" style="color:#F00"></i></a>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="sarana_berdagang">Sarana Berdagang</label>
										<div class="col-sm-5">
											<select class="form-control input-sm select2 required" id="sarana_berdagang" name="sarana_berdagang" style="width:100%;">
												<?php foreach ($sarana_berdagang as $value) : ?>
													<option <?= $value === $toko->sarana_berdagang ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="area_usaha">Area/Kawasan Usaha</label>
										<div class="col-sm-5">
											<select class="form-control input-sm select2" id="area_usaha" name="area_usaha" style="width:100%;">
												<?php foreach ($area_usaha as $value) : ?>
													<option <?= $value === $toko['area_usaha'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Produk utama</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm required" name="produk_utama" id="produk_utama" value="<?= $toko['produk_utama'] ?>" type="text" placeholder="Produk Utama" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="kategori_toko">Kategori Toko</label>
										<div class="col-sm-5">
											<select class="form-control input-sm select2 required" id="kategori_toko" name="kategori_toko" style="width:100%;">
												<?php foreach ($kategori_toko as $value) : ?>
													<option <?= $value === $toko['kategori_toko'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
                                    <!-- End Klasifikasi Usaha -->

                                    <!-- Start Klasifikasi Usaha -->
									<div class="form-group">
										
                                        <label class="col-sm-3 control-label" style="text-align:left;" for="email_toko">Email</label>
										<div class="col-sm-5">
                                            <input maxlength="50" class="form-control input-sm" name="email_toko" id="email_toko" value="<?= $toko['email_toko'] ?>" type="text" placeholder="Email" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left; color:#999">SOSIAL MEDIA</label>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="website">Website</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="website" id="website" value="<?= $toko['website'] ?>" type="text" placeholder="Website" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="fb">Facebook</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="fb" id="fb" value="<?= $toko['fb'] ?>" type="text" placeholder="Nama Facebook" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="ig">Instagram</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="ig" id="ig" value="<?= $toko['fb'] ?>" type="text" placeholder="Nama Akun Instagram" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="youtube">Youtube</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="youtube" id="youtube" value="<?= $toko['youtube'] ?>" type="text" placeholder="Chanel Youtube" />
										</div>
									</div>
                                    <!-- End Klasifikasi Usaha -->
                                    <!-- Start Perizinan Usaha -->
                                                                        
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left; color:#999">IZIN USAHA</label>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="skdu">SKDU (Surat Keterangan Domisili Usaha)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="skdu" id="skdu" value="<?= $toko['skdu'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="iud">IUD (Izin Usaha Dagang)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="iud" id="iud" value="<?= $toko['iud'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="npwp">NPWP (Nomor Pokok Wajib Pajak)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="npwp" id="npwp" value="<?= $toko['npwp'] ?>" type="text" placeholder="Nomor NPWP" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="situ">SITU (Surat Izin Tempat Usaha)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="situ" id="situ" value="<?= $toko['situ'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="siui">SIUI (Surat Izin Usaha Industri)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="siui" id="siui" value="<?= $toko['siui'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="sip">SIP (Surat Izin Prinsip)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="sip" id="sip" value="<?= $toko['sip'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="siup">SIUP (Surat Izin Usaha Perdagangan)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="siup" id="siup" value="<?= $toko['siup'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="tdp">TDP (Tanda Daftar Perusahaan)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="tdp" id="tdp" value="<?= $toko['tdp'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="tdi">TDI (Tanda Daftar Industri)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="tdi" id="tdi" value="<?= $toko['tdi'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="imb">IMB (Surat Izin Mendirikan Bangunan)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="imb" id="imb" value="<?= $toko['imb'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="bpom">BPOM (Badan Pengawas Obat dan Makanan)</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="bpom" id="bpom" value="<?= $toko['bpom'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="ho">HO Surat Izin Gangguan</label>
										<div class="col-sm-5">
											<input maxlength="50" class="form-control input-sm" name="ho" id="ho" value="<?= $toko['ho'] ?>" type="text" placeholder="Nomor Surat" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="keterangan">Keterangan</label>
										<div class="col-sm-7">
                                            <textarea id="keterangan" class="form-control input-sm" type="text" placeholder="Keterangan" name="keterangan"><?= $toko['keterangan'] ?></textarea>											
										</div>
									</div>
                                    
                                    
                                    <!-- End Perizinan Usaha -->
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="col-xs-12">
								<button type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
								<button type="submit" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
