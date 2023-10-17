<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengelolaan Kategori Lembaga</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('lembaga'); ?>"> Daftar Lembaga</a></li>
			<li><a href="<?= site_url('lembaga_master'); ?>"> Daftar Ketegori Lembaga</a></li>
			<li class="active">Pengelolaan Kategori Lembaga</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('lembaga_master'); ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Kategori lembaga</a>
			</div>
			<form id="validasi" action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="nama">Klasifikasi/Kategori lembaga</label>
						<div class="col-sm-8">
							<input id="lembaga" class="form-control input-sm required" type="text" placeholder="Kategori lembaga" name="lembaga" value="<?= $lembaga_master['lembaga']; ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="Deskripsi">Deskripsi lembaga</label>
						<div class="col-sm-8">
						 	<textarea name="deskripsi" class="form-control input-sm" placeholder="Deskripsi lembaga" rows="3"><?= $lembaga_master['deskripsi']; ?></textarea>
						 </div>
					</div>
				</div>
				<div class="box-footer">
					<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</form>
		</div>
	</section>
</div>
