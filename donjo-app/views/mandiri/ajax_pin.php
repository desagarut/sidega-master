<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('global/validasi_form'); ?>
<script>
	$(function () {
		$('.select2').select2()
	});
</script>
<form action="<?= $form_action; ?>" method="post" id="validasi">
	<div class="modal-body">
		<?php if ( ! $id_pend):?>
			<div class="form-group">
				<label for="id_pend">NIK / Nama Penduduk <?= $id_pend; ?></label>
				<select class="form-control input-sm select2 required" id="id_pend" name="id_pend">
					<option option value="">-- Silakan Cari NIK - Nama Penduduk --</option>
					<?php foreach ($penduduk as $data): ?>
						<option value="<?= $data['id']; ?>" <?= selected($id_pend, $data['id']); ?>><?= $data['nik'] . " - " . $data['nama']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>
		<div class="form-group">
			<label class="control-label" for="pin">PIN</label>
			<input id="pin" name="pin" class="form-control input-sm digits" minlength="6" maxlength="6" type="text" placeholder="PIN Warga"></input>
			<p class="help-block"><code>*) Jika PIN tidak di isi maka sistem akan menghasilkan PIN secara acak.</code></p>
			<p class="help-block"><code>**) 6 (enam) digit Angka.</code></p>
		</div>
	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-social btn-box btn-danger btn-sm pull-left"><i class='fa fa-times'></i> Batal</button>
		<button type="submit" class="btn btn-social btn-box btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Simpan</button>
	</div>
</form>
