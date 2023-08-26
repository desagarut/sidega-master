<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('global/validasi_form'); ?>
<form action="<?= $form_action; ?>" method="post" id="validasi" target="_blank">
	<div class="modal-body">
		<div class="form-group">
			<label for="pamong_ttd">Laporan Ditandatangani</label>
			<select class="form-control input-sm required select2" name="pamong_ttd">
				<option value="">Pilih Staf Pemerintah <?= ucwords($this->setting->sebutan_desa)?></option>
				<?php foreach ($pamong AS $data): ?>
					<option value="<?= $data['pamong_id']?>" <?= selected($pamong_ttd['pamong_id'], $data['pamong_id'])?>><?= $data['nama']?> (<?= $data['jabatan']?>)</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="pamong_ketahui">Laporan Diketahui</label>
			<select class="form-control input-sm required select2" name="pamong_ketahui">
				<option value="">Pilih Staf Pemerintah <?= ucwords($this->setting->sebutan_desa)?></option>
				<?php foreach ($pamong AS $data): ?>
					<option value="<?= $data['pamong_id']?>" <?= selected($pamong_ketahui['pamong_id'], $data['pamong_id'])?>><?= $data['nama']?> (<?= $data['jabatan']?>)</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-social btn-flat btn-danger btn-sm pull-left"><i class="fa fa-times"></i> Batal</button>
		<button type="submit" class="btn btn-social btn-flat btn-info btn-sm"><i class='fa fa-check'></i> <?= ucwords($aksi); ?></button>
	</div>
</form>
<script type="text/javascript">
	$('document').ready(function() {
		$('#validasi').submit(function() {
			if ($('#validasi').valid())
				$('#modalBox').modal('hide');
		});
	});
</script>
