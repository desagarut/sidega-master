<?php $this->load->view('global/validasi_form'); ?>

<form action="<?= $form_action; ?>" method="post" id="validasi">

	<div class='modal-body'>

		<div class="form-group">

			<label class="control-label" for="kode_jawaban">Kode</label>

			<input id="kode_jawaban" class="form-control input-sm required bilangan" type="text" placeholder="Kode" name="kode_jawaban" value="<?= $analisis_parameter['kode_jawaban']; ?>">

		</div>

		<div class="form-group">

			<label class="control-label" for="jawaban">Jawaban</label>

			<textarea id="jawaban" class="form-control input-sm required" placeholder="Jawaban" name="jawaban" rows="5"><?= $analisis_parameter['jawaban']; ?></textarea>

		</div>

		<div class="form-group">

			<label class="control-label" for="nilai">Nilai / Ukuran</label>

			<input id="nilai" class="form-control input-sm required bilangan" type="text" min="0" max="999" placeholder="Nilai" name="nilai" value="<?= $analisis_parameter['nilai']; ?>">

		</div>

	</div>

	<div class="modal-footer">

		<button type="reset" class="btn btn-social btn-box btn-danger btn-sm pull-left"><i class='fa fa-times'></i> Batal</button>

		<button type="submit" class="btn btn-social btn-box btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Simpan</button>

	</div>

</form>

