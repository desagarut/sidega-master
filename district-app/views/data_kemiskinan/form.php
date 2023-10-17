<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Form DTKS</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_kemiskinan')?>"> Program Bantuan</a></li>
			<li class="active">Form DTKS</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('data_kemiskinan')?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
			</div>
			<form id="validasi" action="<?= $form_action; ?>" method="POST" class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="id_master">Sasaran Data</label>
						<div class="col-sm-7">
							<?php if ($data_kemiskinan['jml'] <> 0): ?>
								<input type="hidden" name="sasaran" value="<?= $data_kemiskinan['sasaran']; ?>">
								<select class="form-control input-sm" disabled>
							<?php else: ?>
								<select class="form-control input-sm required" name="sasaran">
							<?php endif;?>
							<option value="">Pilih Sasaran</option>
							<?php foreach ($list_sasaran AS $key => $value): ?>
								<?php if (in_array($key, ['1', '2'])) : ?>
									<option value="<?= $key; ?>" <?= selected($data_kemiskinan['sasaran'], $key); ?>><?= $value?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tahun">Tahun</label>
						<div class="col-sm-1">
							<input class="form-control input-sm" maxlength="4" type="text" placeholder="Tahun" name="tahun" id="tahun" value="<?= $data_kemiskinan['tahun']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="nama">Nama Kategori Data Kemiskinan</label>
						<div class="col-sm-7">
							<input class="form-control input-sm nomor_sk required" maxlength="100" type="text" placeholder="Nama Kelompok Data Kemiskinan" name="nama" id="nama" value="<?= $data_kemiskinan['nama']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
						<div class="col-sm-7">
							 <textarea name="keterangan" id="keterangan" class="form-control input-sm" placeholder="Keterangan" rows="3" style="resize:none;"><?= $data_kemiskinan['keterangan']?></textarea>
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
