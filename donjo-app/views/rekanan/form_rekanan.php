<div class="content-wrapper">
	<section class="content-header">
		<h1>Formulir Rekanan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('rekanan') ?>"><i class="fa fa-dashboard"></i> Daftar Rekanan</a></li>
			<li class="active">Formulir Rekanan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="box box-info">
				<div class="box-header with-border">
					<a href="<?= site_url("rekanan"); ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Rekanan">
						<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Rekanan
					</a>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Kode Rekanan</label>
								<div class="col-sm-9">
									<input class="form-control input-sm required" name="kode_rekanan" id="kode_rekanan" value="<?= $rekanan['kode_rekanan'] ?>" type="text" placeholder="Kode Rekanan" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;" for="jenis_rekanan">Jenis Rekanan</label>
								<div class="col-sm-3">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">NIK Rekanan</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="nik_rekanan" id="nik_rekanan" value="<?= $rekanan['nik_rekanan'] ?>" type="text" placeholder="NIK Rekanan" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">NPWP Rekanan</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="npwp_rekanan" id="npwp_rekanan" value="<?= $rekanan['npwp_rekanan'] ?>" type="text" placeholder="NPWP" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Nama Rekanan</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="nama_rekanan" id="nama_rekanan" value="<?= $rekanan['nama_rekanan'] ?>" type="text" placeholder="nama_rekanan Rekanan" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Nama Instansi</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="nama_instansi" id="nama_instansi" value="<?= $rekanan['nama_instansi'] ?>" type="text" placeholder="nama_rekanan Instansi" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Jenis Usaha</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="jenis_usaha" id="jenis_usaha" value="<?= $rekanan['jenis_usaha'] ?>" type="text" placeholder="Jenis Usaha" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Nama Bank</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="nama_bank" id="nama_bank" value="<?= $rekanan['nama_bank'] ?>" type="text" placeholder="nama_rekanan Bank" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Nama Cabang</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="nama_cabang" id="nama_cabang" value="<?= $rekanan['nama_cabang'] ?>" type="text" placeholder="nama_rekanan Cabang" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">No. Rekening</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="no_rek" id="no_rek" value="<?= $rekanan['no_rek'] ?>" type="text" placeholder="No. Rekening" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Nama Rekening</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="nama_rekening" id="nama_rekening" value="<?= $rekanan['nama_rekening'] ?>" type="text" placeholder="nama_rekanan Pemilik Rekening" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Telepon</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="telepon" id="telepon" value="<?= $rekanan['telepon'] ?>" type="text" placeholder="Nomor Telepon" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Email</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="email" id="email" value="<?= $rekanan['email'] ?>" type="text" placeholder="Email" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 control-label" style="text-align:left;">Alamat</label>
								<div class="col-sm-9">
									<input class="form-control input-sm" name="alamat" id="alamat" value="<?= $rekanan['alamat'] ?>" type="text" placeholder="Alamat Lengkap" />
								</div>
							</div>
							<?php if ($rekanan['gambar']) : ?>
								<div class="form-group">
									<label class="control-label col-sm-4" for="nama_rekanan"></label>
									<div class="col-sm-6">
										<input type="hidden" name="old_gambar" value="<?= $rekanan['gambar'] ?>">
										<img class="attachment-img img-responsive img-circle" style="width:200px" src="<?= AmbilGaleri($rekanan['gambar'], 'sedang') ?>" alt="Gambar Album">
									</div>
								</div>
							<?php endif; ?>
							<div class="form-group">
								<label class="control-label col-sm-3" for="upload">Unggah Gambar</label>
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
					</div>
				</div>
				<div class='box-footer'>
					<div class='col-xs-12'>
						<button type='reset' class='btn btn-social btn-box btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
						<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>