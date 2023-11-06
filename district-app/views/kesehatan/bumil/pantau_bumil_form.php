<style>
	/*.input-sm {
	//	padding: 4px 4px;
	}*/
</style>
<div class="box">
	<div class="box-body">
		<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" id="this_url" value="<?= $this_url ?>">
					<!--<input type="hidden" name="status_covid" id="status_covid" >-->
					<input type="hidden" id="page" name="page" value="<?= $page ?>">

					<div class="form-group">
						<label for="nama" class="col-sm-4 control-label required">NIK/Nama</label>
						<div class="col-sm-8">
							<select class="form-control select2 input-sm" id="terdata" name="terdata" style="width: 100%;">
								<option value="">-- Silakan Masukan NIK / Nama--</option>
								<?php foreach ($bumil_array as $item) : ?>
									<option value="<?= $item['id'] ?>"> <?= $item['terdata_id'] . " - " . $item['nama'] ?> </option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="tgl_jam" class="col-sm-4 control-label required">Tanggal/Jam Input Data</label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm" name="tgl_jam" id="tgl_jam" value="<?= $datetime_now; ?>">
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label for="tgl_jam">Hari Pertama Haid Terakhir (HPHT)</label>
							<input type="text" class="form-control input-sm" name="tgl_terdaftar" id="tgl_terdaftar" value="<?= $datetime_now; ?>" disabled>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="tgl_jam">Data H+</label>
							<input type="text" class="form-control input-sm" name="h_plus" id="h_plus" value="3" disabled>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="suhu" class="col-sm-4 control-label required">Suhu Tubuh</label>
					<div class="col-sm-4">
						<input type="text" class="form-control input-sm required" name="suhu" id="suhu" placeholder="36.75">
					</div>
				</div>
				<div class="form-group">
					<label for="bb_pantau" class="col-md-4 control-label required">BB (Gram)</label>
					<div class="col-sm-4">
						<input type="text" class="form-control input-sm required" name="bb_pantau" id="bb_pantau" placeholder="Gram">
					</div>
				</div>
				<div class="form-group">
					<label for="tb_pantau" class="col-md-4 control-label required">TB (Cm)</label>
					<div class="col-sm-4">
						<input type="text" class="form-control input-sm" name="tb_pantau" id="tb_pantau" placeholder="Cm">
					</div>
				</div>
				<div class="form-group">
					<label for="lila_pantau">Lingkar Lengan Atas (lila)</label>
					<input type="text" class="form-control input-sm" name="lila_pantau" id="lila_pantau" placeholder="">
				</div>
				<div class="form-group">
					<label for="pmt_pantau">PMT diterima (Kg)</label>
					<input type="text" class="form-control input-sm" name="pmt_pantau" id="pmt_pantau" placeholder="Kg">
				</div>
				<div class="form-group">
					<label for="vita_pantau">Vitamin A</label>
					<input type="text" class="form-control input-sm" name="vita_pantau" id="vita_pantau" placeholder="">
				</div>
				<div class="form-group">
					<label for="kpsp_pantau">KPSP</label>
					<input type="checkbox" class="form-check-input" name="kpsp_pantau">
				</div>

				<div class="table-responsive-sm">
					<table class="table table-borderless table-sm">
						<thead>
							<tr>
								<th colspan="2" class="text-left">Centang jika mengalami kondisi berikut</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="20%" class="text-center">
									<input type="checkbox" class="form-check-input" name="batuk">
								</td>
								<td>Batuk</td>
							</tr>
							<tr>
								<td width="20%" class="text-center">
									<input type="checkbox" class="form-check-input" name="flu">
								</td>
								<td>Flu</td>
							</tr>
							<tr>
								<td width="20%" class="text-center">
									<input type="checkbox" class="form-check-input" name="sesak">
								</td>
								<td>Sesak nafas</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="form-group">
					<label for="keluhan">Keluhan Lain</label>
					<textarea name="keluhan" class="form-control input-sm" placeholder="Keluhan Lain" rows="3" style="resize:none;"></textarea>
				</div>
			</div>
		</form>
	</div>
	<div class="box-footer">
		<div class="box-tools pull-right">
			<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right" onclick="$('#'+'validasi').submit();"><i class="fa fa-check"></i> Simpan</button>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$("#unique_date_select").val($("#hidden_unique_date_select").val());
		$("#unique_nik_select").val($("#hidden_unique_nik_select").val());

		//https://momentjs.com/docs/#/parsing/string-format/
		$('#tgl_jam').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
		});

		function change_arrival_date() {
			var retval = 0;
			if ($("#terdata").val() != "") {
				$("#status_covid").val($("#terdata").find(':selected').data('statuscovid'));
				var temp1 = new Date($("#terdata").find(':selected').data('tgltiba'));
				var tgl_terdaftar = new Date(temp1.getFullYear() + "-" + (temp1.getMonth() + 1) + "-" + temp1.getDate());

				var temp2 = new Date($('#tgl_jam').val());
				var tgl_catat = new Date(temp2.getFullYear() + "-" + (temp2.getMonth() + 1) + "-" + temp2.getDate());

				var timediff = tgl_catat - tgl_terdaftar;
				var diffdays = Math.floor(timediff / 86400000);

				$("#tgl_terdaftar").val($("#terdata").find(':selected').data('tgltiba'));
				$("#h_plus").val(diffdays);

				retval = diffdays;
			} else {
				$("#tgl_terdaftar").val("");
				$("#h_plus").val("");
			}

			return retval;
		}

		$("#tgl_terdaftar").val("");
		$("#h_plus").val("");
		$("#terdata").change(function() {
			var diff_day = change_arrival_date();

			var tgl_terdaftar = moment().subtract(diff_day, 'days').millisecond(0).second(0).minute(0).hour(0);
			var date_now = moment();

			$('#tgl_jam').data("DateTimePicker").options({
				minDate: tgl_terdaftar,
				maxDate: date_now
			});
		});

		$('#tgl_jam').on('dp.change', function(e) {
			//var formatedValue = e.date.format(e.date._f);
			change_arrival_date();
		});

		$("#unique_date_select").change(function() {
			url = $("#this_url").val();
			url += "/" + $("#page").val();
			url += "/" + $("#unique_date_select").val();
			url += "/" + $("#unique_nik_select").val();
			$(location).attr('href', url);
		});

		$("#unique_nik_select").change(function() {
			url = $("#this_url").val();
			url += "/" + $("#page").val();
			url += "/" + $("#unique_date_select").val();
			url += "/" + $("#unique_nik_select").val();
			$(location).attr('href', url);
		});

		$("#validasi").validate({
			rules: {
				terdata: "required",
				tgl_jam: "required",
				suhu: {
					required: true,
					number: true,
					min: 10,
					max: 50,
				},
			},
			// Specify validation error messages
			messages: {
				terdata: "Harus memilih NIK/Nama",
				tgl_jam: "Tanggal/Jam harus diisi",
				suhu: {
					required: "Suhu harus tercatat",
					number: "Harus diisi angka",
					min: "Suhu minimal 10 derajat celcius",
					max: "Suhu maksimal 50 derajat celcius",
				},
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>