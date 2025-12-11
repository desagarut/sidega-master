<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/validasi.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/localization/messages_id.js"></script>
<script>
	//File Upload
	$('#file_browser').click(function(e) {
		e.preventDefault();
		$('#file').click();
	});

	$('#file').change(function() {
		$('#file_path').val($(this).val());
	});

	$('#file_path').click(function() {
		$('#file_browser').click();
	});
	//Fortmat Tanggal
	$('#tgl_1').datetimepicker({
		format: 'DD-MM-YYYY'
	});
</script>
<form id="validasi" action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
	<div class='modal-body'>
		<div class="box-header with-border">
			<h3 class="box-title">Informasi Buku Aspirasi</h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover tabel-rincian">
					<tbody>
						<tr>
							<td width="20%"><?= $judul_peserta ?></td>
							<td width="1">:</td>
							<td><?= $peserta_nama ?></td>
						</tr>
						<tr>
							<td><?= $judul_peserta_info ?></td>
							<td>:</td>
							<td><?= $peserta_info ?></td>
						</tr>
						<tr>
							<td><?= $tahun ?></td>
							<td>:</td>
							<td><?= $tahun ?></td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
		<div class="box-header with-border">
			<h3 class="box-title">Detail Aspirasi Yang Disampaikan</h3>
		</div>
		<div class="box-body">
			<input type="hidden" name="program_id" value="<?= $program_id ?>" />
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
						<label class="col-sm-3 control-label" for="aspirasiyangdisampaikan">Aspirasi Yang Disampaikan</label>
						<div class="col-sm-8">
							<textarea id="aspirasiyangdisampaikan" name="aspirasiyangdisampaikan" class="form-control input-sm required" placeholder="Tindak Lanjut" maxlength="1500" rows="8"><?= $aspirasiyangdisampaikan ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tindaklanjut">Tindak Lanjut</label>
						<div class="col-sm-8">
							<textarea id="tindaklanjut" name="tindaklanjut" class="form-control input-sm" placeholder="Tindak Lanjut" maxlength="1500" rows="8"><?= $tindaklanjut ?></textarea>
						</div>
					</div>
			<?php if ($dokumen): ?>
				<div class="form-group">
					<label class="control-label col-sm-4" for="nama"></label>
					<div class="col-sm-6">
						<input type="hidden" name="old_gambar" value="<?= $dokumen ?>">
						<img class="attachment-img img-responsive img-circle" src="<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($dokumen) ?>" alt="Gambar">
						<p><label class="control-label"><input type="checkbox" name="gambar_hapus" value="<?= $dokumen ?>" /> Hapus Gambar</label></p>
					</div>
				</div>
			<?php endif; ?>
			<div class="form-group">
				<label for="gambar_peserta" class="col-sm-4 control-label">Gambar Kartu Peserta</label>
				<div class="col-sm-7">
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
	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
		<button type="submit" class="btn btn-social btn-box btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Simpan</button>
	</div>
</form>