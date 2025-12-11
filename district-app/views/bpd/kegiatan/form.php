<script type="text/javascript" src="<?= base_url() ?>assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		selector: 'textarea',
		height: 500,
		theme: 'silver',
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor responsivefilemanager code laporan_keuangan penerima_bantuan sotk"
		],
		toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
		toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor | print preview code | fontselect fontsizeselect",
		image_advtab: true,
		external_filemanager_path: "<?= base_url() ?>assets/filemanager/",
		filemanager_title: "Responsive Filemanager",
		filemanager_access_key: "<?= $this->session->fm_key; ?>",
		external_plugins: {
			"filemanager": "<?= base_url() ?>assets/filemanager/plugin.min.js"
		},
		templates: [{
				title: 'Test template 1',
				content: 'Test 1'
			},
			{
				title: 'Test template 2',
				content: 'Test 2'
			}
		],
		content_css: [
			'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			'//www.tinymce.com/css/codepen.min.css'
		],
		relative_urls: false,
		remove_script_host: false
	});
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Administrasi BPD - Form Kegiatan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bpd_buku_kegiatan') ?>"><i class="fa fa-dashboard"></i> Daftar Kegiatan</a></li>
			<li class="active">Form Kegiatan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("bpd_buku_kegiatan") ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Kegiatan
							</a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="control-label col-sm-3" for="nama">Nama Kegiatan</label>
								<div class="col-sm-9">
									<input name="nama" class="form-control input-sm required" maxlength="100" type="text" value="<?= $bpd_buku_kegiatan['nama'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="jenis">Jenis Kegiatan</label>
								<div class="col-sm-9">
									<input name="jenis" class="form-control input-sm required" maxlength="100" type="text" value="<?= $bpd_buku_kegiatan['jenis'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="pelaksana">Pelaksana</label>
								<div class="col-sm-9">
									<input name="pelaksana" class="form-control input-sm required" maxlength="100" type="text" value="<?= $bpd_buku_kegiatan['pelaksana'] ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal_kegiatan"  class="col-sm-3 control-label">Tanggal Kegiatan</label>
								<div class="col-sm-3 col-lg-2">
									<div class="input-group input-group-sm">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input title="Pilih Tanggal" id="tgl_mulai" class="form-control input-sm required" name="tgl_mulai" type="text" value="<?= $bpd_buku_kegiatan['tgl_mulai'] ?>"/>
									</div>
								</div>
								<div class="col-sm-3 col-lg-2">
									<div class="input-group input-group-sm">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input title="Pilih Tanggal" id="tgl_akhir" class="form-control input-sm required" name="tgl_akhir" type="text" value="<?= $bpd_buku_kegiatan['tgl_akhir'] ?>"/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="hasil">Agenda & Hasil Kegiatan</label>
								<div class="col-sm-9">
									<textarea name="hasil" class="form-control input-sm required" style="height:350px;">
									<?= $bpd_buku_kegiatan['hasil'] ?>
								</textarea>
								</div>
							</div>
							<?php if ($bpd_buku_kegiatan['gambar']) : ?>
								<div class="form-group">
									<label class="control-label col-sm-3" for="gambar"></label>
									<div class="col-sm-9">
										<input type="hidden" name="old_gambar" value="<?= $bpd_buku_kegiatan['gambar'] ?>">
										<img class="attachment-img img-responsive" style="width: 30%" src="<?= AmbilGaleri($bpd_buku_kegiatan['gambar'], 'kecil') ?>" alt="Gambar Album">
									</div>
								</div>
							<?php endif; ?>
							<div class="form-group">
								<label class="control-label col-sm-3" for="upload">Foto Sampul</label>
								<div class="col-sm-3">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control <?php !($bpd_buku_kegiatan['gambar']) and print('required') ?>" id="file_path">
										<input id="file" type="file" class="hidden" name="gambar">
										<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
										</span>
									</div>
									<?php $upload_mb = max_upload(); ?>
									<p><label class="control-label">Batas maksimal ukuran foto <strong><?= $upload_mb ?> MB.</strong></label></p>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="keterangan">Deskripsi</label>
								<div class="col-sm-9">
									<input name="keterangan" class="form-control input-sm" maxlength="100" type="text" value="<?= $bpd_buku_kegiatan['keterangan'] ?>"></input>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="col-xs-12">
								<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
								<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right confirm"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>