<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Form Anjungan Layanan Mandiri</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('anjungan')?>"> Daftar Anjungan</a></li>
			<li class="active">Form Anjungan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('anjungan')?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Anjungan</a>
			</div>
			<form action="<?= $form_action; ?>" method="POST" class="form-horizontal form-validasi">
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="ip_address">IP Address</label>
						<div class="col-sm-7">
							<input class="form-control input-sm ip_address required" type="text" placeholder="IP address statis untuk anjungan" name="ip_address" value="<?= $anjungan['ip_address']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
						<div class="col-sm-7">
							 <textarea name="keterangan" class="form-control input-sm" maxlength="300" placeholder="Keterangan" rows="3" style="resize:none;"><?= $anjungan['keterangan']?></textarea>
						 </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="status">Status</label>
						<div class="btn-group col-sm-7" data-toggle="buttons">
							<label id="sx3" class="btn btn-info btn-box btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= jecho($anjungan['status'], '1', 'active') ?>">
								<input type="radio" name="status" class="form-check-input" type="radio" value="1" <?= jecho($anjungan['status'], '1', 'checked') ?>> Aktif
							</label>
							<label id="sx4" class="btn btn-info btn-box btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label <?= jecho($anjungan['status'] != '1', true, 'active') ?>">
								<input type="radio" name="status" class="form-check-input" type="radio" value="0" <?= jecho($anjungan['status'] != '1', true, 'checked') ?>> Tidak Aktif
							</label>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="reset" class="btn btn-social btn-box btn-danger btn-sm" onclick="reset_form($(this).val());"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</form>
		</div>
	</section>
</div>
<script type="text/javascript">
	function reset_form()
	{
		<?php if ($anjungan['status'] == '1'): ?>
			$("#sx3").addClass('active');
			$("#sx4").removeClass("active");
		<?php else: ?>
			$("#sx4").addClass('active');
			$("#sx3").removeClass("active");
		<?php endif ?>
	};
</script>
