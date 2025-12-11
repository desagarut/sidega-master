<div class="content-wrapper">
	<?php $detail = $buku_aspirasi[0]; ?>
	<section class="content-header">
		<h1>Buku BPD - Aspirasi - Detail - Form</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bpd_buku_aspirasi') ?>"> Buku Aspirasi</a></li>
			<li><a href="<?= site_url("bpd_buku_aspirasi/detail/$detail[id]") ?>"> Daftar Aspirasi</a></li>
			<li class="active">Detail Form</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url('bpd_buku_aspirasi') ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Program Bantuan"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Buku Aspirasi</a>
						<a href="<?= site_url("bpd_buku_aspirasi/aspirasi_detail/$detail[id]") ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Rincian Program Bantuan"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Rincian Buku Aspirasi</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<?php include('district-app/views/bpd/aspirasi/aspirasi_rincian.php'); ?>

								<h5><b>Tambah Pemberi Aspirasi</b></h5>
								<hr>
								<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="form-group">
										<label class="col-sm-4 col-lg-3 control-label <?php ($detail['sasaran'] != 1) and print('no-padding-top') ?>" for="nik">Cari <?= $detail['judul_cari_peserta'] ?></label>
										<div class="col-sm-9">
											<select class="form-control select2 input-sm required" id="nik" name="nik" onchange="formAction('main')" style="width:100%">
												<option value="">-- Silakan Masukan <?= $detail['judul_cari_peserta'] ?> --</option>
												<?php foreach ($buku_aspirasi[2] as $item):
													if (strlen($item["id"]) > 0): ?>
														<option value="<?= $item['id'] ?>" <?= selected($individu['nik'], $item['nik']); ?>><?= $item['nama'] . " - " . $item['info'] ?></option>
												<?php endif;
												endforeach; ?>
											</select>
										</div>
									</div>
									<hr>
									<?php if ($individu['nik']): ?>
										<div class="row">
											<div class="col-sm-6">
												<div class="box box-default box-solid">
													<div class="box-header with-border">
														<i class="fa fa-user"></i>
														<h3 class="box-title">Informasi Pemberi Aspirasi</h3>
													</div>
													<div class="box-body">
														<?php include('district-app/views/bpd/aspirasi/informasi_pemberi_aspirasi.php'); ?>
													</div>
												</div>
											</div>
								</form>
								<div class="col-sm-6">
									<div class="box box-success box-solid">
										<div class="box-header with-border">
											<i class="fa fa-credit-card"></i>
											<h3 class="box-title">Aspirasi Yang Disampaikan Form</h3>
										</div>
										<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
											<div class="box-body">
												<input name="peserta" type="hidden" value="<?= $individu['id_peserta'] ?>">
												<input name="kartu_id_pend" type="hidden" value="<?= $individu['id'] ?>">
												<div class="form-group">
													<label for="tanggal" class="col-sm-4 control-label">Tanggal Aspirasi</label>
													<div class="col-sm-7">
														<div class="input-group input-group-sm date">
															<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</div>
															<input class="form-control input-sm pull-right required" id="tgl_1" name="tanggal" placeholder="tanggal" type="text" value="<?= date_format(date_create($tanggal), "d-m-Y") ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="aspirasiyangdisampaikan" class="col-sm-4 col-lg-4 control-label">Aspirasi yang disampaikan </label>
													<div class="col-sm-8">
														<textarea id="aspirasiyangdisampaikan" class="form-control input-sm required" type="text" placeholder="Aspirasi yang disampaikan" name="aspirasiyangdisampaikan"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="tindaklanjut" class="col-sm-4 col-lg-4 control-label">Tindak lanjut </label>
													<div class="col-sm-8">
														<textarea id="tindaklanjut" class="form-control input-sm" type="text" placeholder="Tindak Lanjut" name="tindaklanjut"></textarea>
													</div>
												</div>

												<div class="form-group">
													<label for="jenis_keramaian" class="col-sm-4 col-lg-4 control-label">Dokumen</label>
													<div class="col-sm-8">
														<div class="input-group input-group-sm ">
															<input type="text" class="form-control" id="file_path">
															<input type="file" class="hidden" id="file" name="satuan">
															<span class="input-group-btn">
																<button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
															</span>
														</div>
														<span class="help-block"><code> Kosongkan jika tidak ingin mengunggah gambar</code></span>
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
						<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>