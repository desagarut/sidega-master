<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Dokumen Rekanan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('rekanan') ?>"><i class="fa fa-dashboard"></i> Daftar Album</a></li>
			<li><a href='<?= site_url("rekanan/dokumen_rekanan/$album") ?>'><i class="fa fa-dashboard"></i> Daftar Gambar Album</a></li>
			<li class="active">Form Dokumen Rekanan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("rekanan/dokumen_rekanan/$album") ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Gambar Album
							</a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="control-label col-sm-4" for="nama_rekanan">Nama Gambar</label>
								<div class="col-sm-6">
									<input name="nama_rekanan" class="form-control input-sm nomor_sk" maxlength="50" type="text" value="<?= $rekanan['nama_rekanan'] ?>"></input>
								</div>
							</div>
							<?php if ($rekanan['gambar']) : ?>
								<div class="form-group">
									<label class="control-label col-sm-4" for="nama_rekanan"></label>
									<div class="col-sm-6">
										<input type="hidden" name="old_gambar" value="<?= $rekanan['gambar'] ?>">
										<img class="attachment-img img-responsive img-circle" src="<?= AmbilGaleri($rekanan['gambar'], 'sedang') ?>" alt="Gambar Album">
									</div>
								</div>
							<?php endif; ?>
							<div class="form-group">
								<label class="control-label col-sm-4" for="upload">Unggah Gambar</label>
								<div class="col-sm-6">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control <?php !($rekanan['gambar']) and print('required') ?>" id="file_path">
										<input id="file" type="file" class="hidden" name="gambar">
										<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
										</span>
									</div>
									<?php $upload_mb = max_upload(); ?>
									<p><label class="control-label">Batas maksimal pengunggahan berkas <strong><?= $upload_mb ?> MB.</strong></label></p>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
								<button type='reset' class='btn btn-social btn-box btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
								<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>