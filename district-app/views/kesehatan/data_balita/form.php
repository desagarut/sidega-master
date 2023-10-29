<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Data Balita</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bidang_kesehatan') ?>"> Bidang Kesehatan</a></li>
			<li><a href="<?= site_url('data_balita') ?>"> Data Balita</a></li>
			<li class="active">Form</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div id="umkm" class="col-sm-2">
				<?php $this->load->view('kesehatan/menu') ?>
			</div>
			<div class="col-md-10">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url('data_balita') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
					</div>
					<form id="validasi" action="<?= $form_action; ?>" method="POST" class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="id_master">Sasaran Data</label>
								<div class="col-sm-7">
									<?php if ($data_balita['jml'] <> 0) : ?>
										<input type="hidden" name="sasaran" value="<?= $data_balita['sasaran']; ?>">
										<select class="form-control input-sm" disabled>
										<?php else : ?>
											<select class="form-control input-sm required" name="sasaran">
											<?php endif; ?>
											<option value="">Pilih Sasaran</option>
											<?php foreach ($list_sasaran as $key => $value) : ?>
												<?php if (in_array($key, ['1', '2'])) : ?>
													<option value="<?= $key; ?>" <?= selected($data_balita['sasaran'], $key); ?>><?= $value ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
											</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nama">Nama Kelompok Data</label>
								<div class="col-sm-7">
									<input class="form-control input-sm nomor_sk required" maxlength="100" type="text" placeholder="Nama Kelompok Data" name="nama" id="nama" value="<?= $data_balita['nama'] ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
								<div class="col-sm-7">
									<textarea name="keterangan" id="keterangan" class="form-control input-sm" maxlength="300" placeholder="Keterangan" rows="3" style="resize:none;"><?= $data_balita['keterangan'] ?></textarea>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>