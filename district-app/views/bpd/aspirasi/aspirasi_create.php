<script src="<?= base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url()?>assets/js/localization/messages_id.js"></script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Tambah Buku Aspirasi</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?=site_url('bpd_buku_aspirasi')?>"> Buku Aspirasi</a></li>
			<li class="active">Tambah Buku Aspirasi</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?=site_url('bpd_buku_aspirasi')?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Buku Aspirasi"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Buku Aspirasi</a>
			</div>
			<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<div class="box-body">
					<?php $cid = @$_REQUEST["cid"]; ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Kelompok Pemberi Aspirasi</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="cid" id="cid">
								<option value="" class="text-center"> - Pilih Kelompok Pemberi Aspirasi <?= $cid; ?> -</option>
								<option value="1" <?php selected($cid, 1); ?>>Penduduk Perorangan</option>
								<option value="2" <?php selected($cid, 2); ?>>Keluarga - KK</option>
								<option value="3" <?php selected($cid, 3); ?>>Rumah Tangga</option>
								<option value="4" <?php selected($cid, 4); ?>>Kelompok / Organisasi Masyarakat</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="tahun">Tahun</label>
						<div class="col-sm-2">
							<input name="tahun" class="form-control input-sm required" maxlength="4" placeholder="Tahun"  type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="nama">Nama Buku</label>
						<div class="col-sm-8">
							<input name="nama" class="form-control input-sm required" maxlength="100" placeholder="Nama Buku"  type="text"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="ndesc">Keterangan</label>
						<div class="col-sm-8">
							<textarea id="ndesc" name="ndesc" class="form-control input-sm required" placeholder="Isi Keterangan" rows="8"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tgl_post">Periode</label>
						<div class="col-sm-4">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_1" name="sdate" placeholder="Tgl. Mulai" type="text">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_2" name="edate" placeholder="Tgl. Akhir" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="status">Status</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="status" id="status">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
								<!-- Default Value Aktif -->
							</select>
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<button type='reset' class='btn btn-social btn-box btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
					<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
				</div>
			</form>
		</div>
	</section>
</div>

