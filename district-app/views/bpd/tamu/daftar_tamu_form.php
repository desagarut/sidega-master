<div class="content-wrapper">
	<section class="content-header">
		<h1>BPD - Buku Tamu Form</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bpd_buku_tamu') ?>"><i class="fa fa-dashboard"></i> Buku Tamu</a></li>
			<li><a href='<?= site_url("bpd_buku_tamu/daftar_tamu/$buku") ?>'><i class="fa fa-dashboard"></i> Daftar Tamu</a></li>
			<li class="active">Form</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("bpd_buku_tamu/daftar_tamu/$buku") ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Tamu
							</a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="tanggal" class="col-sm-4 control-label">Tanggal Kunjungan </label>
								<div class="col-sm-2">
									<div class="input-group input-group-sm date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input class="form-control input-sm pull-right required" id="tgl_1" name="tanggal" placeholder="tanggal" type="text" value="<?= tgl_indo_out($buku_tamu['tanggal'])?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="nama">Nama Lengkap</label>
								<div class="col-sm-6">
									<input name="nama" class="form-control input-sm required" maxlength="50" type="text" value="<?= $buku_tamu['nama'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="jabatan">Jabatan</label>
								<div class="col-sm-6">
									<input name="jabatan" class="form-control input-sm required" maxlength="50" type="text" value="<?= $buku_tamu['jabatan'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="alamat">Alamat</label>
								<div class="col-sm-6">
									<textarea id="alamat" class="form-control input-sm required" type="text" placeholder="Alamat" name="alamat"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="keperluan">Keperluan</label>
								<div class="col-sm-6">
									<textarea id="keperluan" class="form-control input-sm required" type="text" placeholder="Tulis keperluan singkat" name="keperluan"></textarea>
								</div>
							</div>
							<?php if ($buku_tamu['gambar']): ?>
								<div class="form-group">
									<label class="control-label col-sm-4" for="gambar"></label>
									<div class="col-sm-6">
										<input type="hidden" name="old_gambar" value="<?= $buku_tamu['gambar'] ?>">
										<img class="attachment-img img-responsive img-circle" src="<?= AmbilGaleri($buku_tamu['gambar'], 'kecil') ?>" alt="Gambar Album">
									</div>
								</div>
							<?php endif; ?>
							<div class="form-group">
								<label class="control-label col-sm-4" for="upload">Unggah Gambar</label>
								<div class="col-sm-6">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control <?php !($buku_tamu['gambar']) and print('required') ?>" id="file_path">
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