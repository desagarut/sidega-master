<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengaturan Data Dokumentasi Pembangunan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url("potensi_umum_dokumentasi/show/{$id_potensi}") ?>"><i class="fa fa-dashboard"></i>Daftar Dokumentasi Pembangunan</a></li>
			<li class="active">Pengaturan Data Pembangunan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("potensi_umum_dokumentasi/show/{$id_potensi}") ?>" class="btn btn-social btn-flat btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Pembangunan</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<input type="hidden" name="id_potensi" value="<?= $id_potensi ?>">
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;">Judul</label>
										<div class="col-sm-7">
											<input maxlength="50" class="form-control input-sm required" name="judul" id="judul" value="<?= $main->judul ?>" type="text" placeholder="Judul Dokumen" />
										</div>
									</div>

									<?php if ($main->gambar) : ?>
										<div class="form-group">
											<label class="control-label col-sm-4" for="nama"></label>
											<div class="col-sm-6">
												<input type="hidden" name="old_foto" value="<?= $main->gambar ?>">
												<img class="attachment-img img-responsive img-circle" src="<?= base_url() . LOKASI_GALERI . $main->gambar ?>" alt="Gambar Dokumentasi" width="200" height="200">
											</div>
										</div>
									<?php endif; ?>
									<div class="form-group">
										<label class="control-label col-sm-3" for="upload">Unggah Dokumentasi</label>
										<div class="col-sm-7">
											<div class="input-group input-group-sm">
												<input type="text" class="form-control " id="file_path" name="gambar">
												<input id="file" type="file" class="hidden" name="gambar">
												<span class="input-group-btn">
													<button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
												</span>
											</div>
											<span class="help-block"><code>(Kosongkan jika tidak ingin mengubah gambar)</code></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" style="text-align:left;" for="keterangan">Keterangan</label>
										<div class="col-sm-7">
											<textarea rows="5" class="form-control input-sm required" name="keterangan" id="keterangan" placeholder="Keterangan"><?= $main->keterangan ?></textarea>
										</div>
									</div>
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
<script>
	function pilih_persentase(pilih) {
		if (pilih == 1) {
			$('#persentase').val('');
			$('#persentase').removeClass('required');
			$("#manual").hide();
			$("#pilih").show();
			$('#id_persentase').addClass('required');
		} else {
			$('#id_persentase').val('');
			$('#id_persentase').trigger('change', true);
			$('#id_persentase').removeClass('required');
			$("#manual").show();
			$('#persentase').addClass('required');
			$("#pilih").hide();
		}
	}

	$(document).ready(function() {
		pilih_persentase(<?= in_array($main->persentase, $persentase) ? 1 : 2 ?>);
	});
</script>
