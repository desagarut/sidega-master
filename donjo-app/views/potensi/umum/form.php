<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Potensi Umum</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('potensi_umum') ?>"><i class="fa fa-dashboard"></i>Potensi Umum</a></li>
			<li class="active">Form</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-4 col-lg-3">
					<?php $this->load->view('potensi/menu.php')?>
				</div>
				<div class="col-md-8 col-lg-9">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url('potensi_umum') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
                                    	<label class="col-sm-3 control-label" style="text-align:left; color:#999">DATA UMUM</label>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Tahun Pembentukan</label>
										<div class="col-sm-2">
											<input maxlength="4" class="form-control input-sm required" name="tahun_pembentukan" id="tahun_pembentukan" value="<?= $main->tahun_pembentukan ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Luas Desa (Ha)</label>
										<div class="col-sm-3">
											<input maxlength="20" class="form-control input-sm" name="luas_desa" id="luas_desa" value="<?= $main->luas_desa ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Nama Kepala <?= ucwords($this->setting->sebutan_desa)?> *</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm required" name="nama_kepala" id="nama_kepala" value="<?= $main->nama_kepala ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Nama Pengisi</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="nama_pengisi" id="nama_pengisi" value="<?= $main->nama_pengisi ?>" type="text" placeholder="" />
										</div>
									</div>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Pekerjaan</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="pekerjaan_pengisi" id="pekerjaan_pengisi" value="<?= $main->pekerjaan_pengisi ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Jabatan</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="jabatan_pengisi" id="jabatan_pengisi" value="<?= $main->jabatan_pengisi ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="bulan_laporan">Bulan Laporan</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" id="bulan_laporan" name="bulan_laporan" style="width:100%;">
												<?php foreach ($bulan_laporan as $value) : ?>
													<option <?= $value === $main->bulan_laporan ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="tahun_laporan">Tahun</label>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" id="tahun_laporan" name="tahun_laporan" style="width:100%;">
												<?php for ($i = date('Y'); $i >= 2010; $i--) : ?>
													<option value="<?= $i ?>"><?= $i ?></option>
												<?php endfor; ?>
											</select>
											<script>
												$('#tahun_laporan').val("<?= $main->tahun_laporan?>");
											</script>
										</div>
									</div>
                                    
                                    
                                    
                                    <!-- Batas Wilayah -->
									<div class="form-group">
                                    	<label class="col-sm-3 control-label" style="text-align:left; color:#999">BATAS WILAYAH</label>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Desa/Kelurahan Sebelah Utara</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_desa_utara" id="batas_desa_utara" value="<?= $main->batas_desa_utara ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Desa/Kelurahan Sebelah Selatan</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_desa_selatan" id="batas_desa_selatan" value="<?= $main->batas_desa_selatan ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Desa/Kelurahan Sebelah Timur</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_desa_timur" id="batas_desa_timur" value="<?= $main->batas_desa_timur ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Desa/Kelurahan Sebelah Barat</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_desa_barat" id="batas_desa_barat" value="<?= $main->batas_desa_barat ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Kecamatan Sebelah Utara</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_kec_utara" id="batas_kec_utara" value="<?= $main->batas_kec_utara ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Kecamatan Sebelah Selatan</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_kec_selatan" id="batas_kec_selatan" value="<?= $main->batas_kec_selatan ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Kecamatan Sebelah Timur</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_kec_timur" id="batas_kec_timur" value="<?= $main->batas_kec_timur ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Kecamatan Sebelah Barat</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="batas_kec_barat" id="batas_kec_barat" value="<?= $main->batas_kec_barat ?>" type="text" placeholder="" />
										</div>
									</div>
                                  
                                    <!-- Penetapan Batas Wilayah -->
									<div class="form-group">
                                    	<label class="col-sm-3 control-label" style="text-align:left; color:#999">PENETAPAN BATAS WILAYAH</label>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label" for="penetapan_batas">Penetapan Batas</label>
                                        <div class="col-sm-2">
                                             <select class="form-control input-sm" name="penetapan_batas" id="penetapan_batas">
                                                <option value="1" <?php selected($penetapan_batas, '1'); ?> >Ada</option>
                                                <option value="0" <?php selected($penetapan_batas, '0'); ?> >Tidak Ada</option>
                                            </select>
                                         </div>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Dasar Hukum Perdes No.</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="no_perdes" id="no_perdes" value="<?= $main->no_perdes ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Dasar Hukum Perda No.</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="no_perda" id="no_perda" value="<?= $main->no_perda ?>" type="text" placeholder="" />
										</div>
									</div>
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label" for="peta_wilayah">Peta Wilayah</label>
                                        <div class="col-sm-2">
                                             <select class="form-control input-sm" name="peta_wilayah" id="peta_wilayah">
                                                <option value="1" <?php selected($peta_wilayah, '1'); ?> >Ada</option>
                                                <option value="0" <?php selected($peta_wilayah, '0'); ?> >Tidak Ada</option>
                                            </select>
                                         </div>
                                    </div>
                                    <!-- Penetapan Batas Wilayah -->
									<div class="form-group">
                                    	<label class="col-sm-3 control-label" style="text-align:left; color:#999">SUMBER DATA</label>
                                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Referensi 1</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="ref1" id="ref1" value="<?= $main->ref1 ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Referensi 2</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="ref2" id="ref2" value="<?= $main->ref2 ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Referensi 3</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="ref3" id="ref3" value="<?= $main->ref3 ?>" type="text" placeholder="" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Referensi 4</label>
										<div class="col-sm-7">
											<input maxlength="100" class="form-control input-sm" name="ref4" id="ref4" value="<?= $main->ref4 ?>" type="text" placeholder="" />
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
	function pilih_lokasi(pilih) {
		if (pilih == 1) {
			$('#lokasi_kantor_desa').val(null);
			$('#lokasi_kantor_desa').removeClass('required');
			$("#manual").hide();
			$("#pilih").show();
			$('#id_lokasi').addClass('required');
		} else {
			$('#id_lokasi').val(null);
			$('#id_lokasi').trigger('change', true);
			$('#id_lokasi').removeClass('required');
			$("#manual").show();
			$('#lokasi_kantor_desa').addClass('required');
			$("#pilih").hide();
		}
	}

	$(document).ready(function() {
		pilih_lokasi(<?= is_null($main->lokasi_kantor_desa) ? 1 : 2 ?>);
	});
</script>
