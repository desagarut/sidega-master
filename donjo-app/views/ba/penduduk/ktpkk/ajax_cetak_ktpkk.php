<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="form-group">
	<div class="form-group">
		<label for="tgl_cetak">Tanggal Cetak</label>
		<div class="input-group input-group-sm date">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			<input class="form-control input-sm pull-right required" id="tgl_1" name="tgl_cetak" type="text" value="<?= date('d-m-Y');?>">
		</div>
	</div>
	<label for="nama">Centang kotak berikut apabila NIK/No. KK ingin disensor</label>
	<div class="form-group">
		<div class="form-check">
			<input type="checkbox" class="form-check-input" id="privasi_nik">
			<label class="form-check-label" for="cetak_privasi_nik">Sensor NIK/No. KK</label>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('document').ready(function()
	{
    $("#privasi_nik").click(function(){
			const privasi_nik = $('#privasi_nik:checked').val();
			if (privasi_nik == "on")
			{
				$("#validasi").attr("action", "<?= $form_action_privasi ?>");
			}
			else
			{
				$("#validasi").attr("action", "<?= $form_action ?>");
			}
    });
	});
</script>

