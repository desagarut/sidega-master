<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Kegiatan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pemberdayaan_pemberdayaan_masyarakat') ?>"> Kegiatan</a></li>
			<li class="active">Form Kegiatan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('pemberdayaan_masyarakat') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Kegiatan</a>
			</div>
			<form id="validasi" action="<?= $form_action; ?>" method="POST" class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="id_master">Sasaran Data</label>
						<div class="col-sm-7">
							<?php if ($pemberdayaan_masyarakat['jml'] <> 0) : ?>
								<input type="hidden" name="sasaran" value="<?= $pemberdayaan_masyarakat['sasaran']; ?>">
								<select class="form-control input-sm" disabled>
								<?php else : ?>
									<select class="form-control input-sm required" name="sasaran">
									<?php endif; ?>
									<option value="">Pilih Sasaran</option>
									<?php foreach ($list_sasaran as $key => $value) : ?>
										<?php if (in_array($key, ['1', '2'])) : ?>
											<option value="<?= $key; ?>" <?= selected($pemberdayaan_masyarakat['sasaran'], $key); ?>><?= $value ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
									</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="nama_kegiatan">Nama Kegiatan</label>
						<div class="col-sm-7">
							<input class="form-control input-sm nomor_sk required" maxlength="100" type="text" placeholder="Nama Kegiatan" name="nama_kegiatan" id="nama_kegiatan" value="<?= $pemberdayaan_masyarakat['nama_kegiatan'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="nama_penyelenggara">Nama Penyelenggara</label>
						<div class="col-sm-7">
							<input class="form-control input-sm nomor_sk required" maxlength="100" type="text" placeholder="Nama Penyelenggara Kegiatan" name="nama_penyelenggara" id="nama_penyelenggara" value="<?= $pemberdayaan_masyarakat['nama_penyelenggara'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tgl_mulai">Tanggal Pelaksanaan</label>
						<div class="col-sm-2">
							<input class="form-control input-sm tgl_1" name="tgl_mulai" type="text" value="<?= tgl_indo_out($pemberdayaan_masyarakat['tgl_mulai']) ?>">
							</div>
						<div class="col-sm-1">
							Sampai
						</div>
						<div class="col-sm-2">
							<input class="form-control input-sm tgl_1" name="tgl_selesai" type="text" value="<?= tgl_indo_out($pemberdayaan_masyarakat['tgl_selesai']) ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="sumber_dana">Sumber Dana</label>
						<div class="col-sm-7">
							<input class="form-control input-sm required" maxlength="100" type="text" placeholder="Sumber Dana" name="sumber_dana" id="sumber_dana" value="<?= $pemberdayaan_masyarakat['sumber_dana'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="anggaran">Anggaran</label>
						<div class="col-sm-7">
							<input class="form-control input-sm required" maxlength="100" type="text" placeholder="Anggaran" name="anggaran" id="anggaran" value="<?= $pemberdayaan_masyarakat['anggaran'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="lokasi">Lokasi Kegiatan</label>
						<div class="col-sm-7">
							<input class="form-control input-sm required" maxlength="100" type="text" placeholder="Lokasi" name="lokasi" id="lokasi" value="<?= $pemberdayaan_masyarakat['lokasi'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
						<div class="col-sm-7">
							<textarea name="keterangan" id="keterangan" class="form-control input-sm" maxlength="300" placeholder="Keterangan" rows="3" style="resize:none;"><?= $pemberdayaan_masyarakat['keterangan'] ?></textarea>
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