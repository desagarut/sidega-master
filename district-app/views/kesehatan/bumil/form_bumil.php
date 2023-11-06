<div class="content-wrapper">

	<section class="content-header">
		<h1>Form Data Bumil</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('kesehatan_bumil') ?>"> Kesehatan Bumil</a></li>
			<li class="active">Form</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div id="kesehatan" class="col-sm-2">
				<?php $this->load->view('kesehatan/bumil/menu') ?>
			</div>
			<div class="col-md-10">
				<div class="box box-info">
					<div class="box-header with-border">
						<div class="col-md-12">
							<a href="<?= site_url('kesehatan_bumil') ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Bumil"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Bumil</a>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="box-header with-border">
									<h3 class="box-title">Tambah / Ubah Data Bumil</h3>
								</div>
								<div class="box-body">
									<form action="" id="main" name="main" method="POST" class="form-horizontal">

										<div class="form-group">
											<label class="col-sm-3 control-label required" for="terdata">NIK / Nama</label>
											<div class="col-sm-4">
												<select class="form-control select2 required" id="terdata" name="terdata" onchange="formAction('main')" style="width: 100%;">
													<option value="">-- Silakan Masukan NIK / Nama--</option>
													<?php foreach ($list_penduduk as $item) :
														if (strlen($item["id"]) > 0) : ?>
															<option value="<?= $item['id'] ?>" <?php selected($individu['id'], $item['id']); ?>>Nama : <?= $item['nama'] . " - " . $item['info'] ?></option>
													<?php endif;
													endforeach; ?>
												</select>
											</div>
											<div class="col-sm-4">
												<a href="#" class="btn btn-social btn-block btn-success btn-sm" data-toggle="modal" data-target="#add-warga">
													<i class="fa fa-plus"></i>
													Tambah Penduduk Belum Terdata SIDeGa
												</a>
												<span id="data_h_plus_msg" class="help-block">
													<code>Untuk penduduk yang pendatang/tidak tetap.</code>
												</span>
											</div>
										</div>
									</form>
									<div id="form-melengkapi-data-peserta">
										<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
											<div class="form-group">
												<label class="col-sm-3 control-label"></label>
												<div class="col-sm-8">
													<input type="hidden" name="id_terdata" value="<?= $individu['id'] ?>" class="form-control input-sm required">
												</div>
											</div>
											<?php if ($individu) : ?>
												<?php include("district-app/views/kesehatan/bumil/konfirmasi_bumil.php"); ?>
											<?php endif; ?>

											<?php include("district-app/views/kesehatan/bumil/form_isian_bumil.php"); ?>

										</form>
									</div>
									<div class="box-footer">
										<div class="col-xs-12">
											<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right" onclick="$('#'+'validasi').submit();"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class='modal fade' id='add-warga' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'><i class='fa fa-plus text-green'></i> Tambah Penduduk Pendatang / Tidak Tetap</h4>
			</div>
			<div class='modal-body'>
				<div class="row">
					<?php include("district-app/views/kesehatan/bumil/form_isian_penduduk.php"); ?>
				</div>
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-social btn-box btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				<a class='btn-ok'>
					<button type="submit" class="btn btn-social btn-box btn-success btn-sm" onclick="$('#'+'form_penduduk').submit();"><i class='fa fa-trash-o'></i> Simpan</button>
				</a>
			</div>
		</div>
	</div>
</div>