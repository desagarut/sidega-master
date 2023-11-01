<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Data Peserta</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pemberdayaan_masyarakat') ?>"> Pemas</a></li>
			<li><a href="<?= site_url() ?>pemberdayaan_masyarakat/rincian/1/<?= $pemas['id'] ?>"> Detail Kegiatan</a></li>
			<li class="active">Form Data Peserta</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url("pemberdayaan_masyarakat"); ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Suplemen"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Suplemen</a>
				<a href="<?= site_url("pemberdayaan_masyarakat/rincian/$pemas[id]"); ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Rincian Data Suplemen</a>
			</div>
			<?php $this->load->view('pemberdayaan_masyarakat/rincian_kegiatan'); ?>
			<div class="box-body">
				<h5><b>Tambahkan Warga Peserta</b></h5>
				<hr>
				<form action="" id="main" name="main" method="POST" class="form-horizontal">
					<div class="form-group">
						<label for="terdata" class="col-sm-3 control-label"><?= $list_sasaran['judul']; ?></label>
						<div class="col-sm-8">
							<select class="form-control select2 required" id="terdata" name="terdata" onchange="formAction('main')">
								<option selected="selected">-- Silakan Masukan <?= $list_sasaran['judul']; ?> --</option>
								<?php foreach ($list_sasaran['data'] as $item) : ?>
									<?php if (strlen($item["id"]) > 0) : ?>
										<option value="<?= $item['id'] ?>" <?= selected($individu['id'], $item['id']); ?>>Nama : <?= $item['nama'] . ' - ' . $item['info']; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</form>
				<div id="form-melengkapi-data-peserta">
					<form id="validasi" action="<?= "$form_action/$pemas[id]"; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label"></label>
							<div class="col-sm-8">
								<input type="hidden" name="id_terdata" value="<?= $individu['id'] ?>" class="form-control input-sm required">
							</div>
						</div>
						<?php if ($individu) : ?>
							<?php include("district-app/views/pemberdayaan_masyarakat/konfirmasi_terdata.php"); ?>
						<?php endif; ?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
							<div class="col-sm-8">
								<textarea name="keterangan" id="keterangan" class="form-control input-sm" maxlength="100" placeholder="Keterangan" rows="5"></textarea>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="box-footer">
				<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right" onclick="$('#'+'validasi').submit();"><i class="fa fa-check"></i> Simpan</button>
			</div>
		</div>
	</section>
</div>