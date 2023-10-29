<script type="text/javascript">
	$(document).ready(function() {
		//https://momentjs.com/docs/#/parsing/string-format/
		$('#tanggal_terdaftar').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>

<div class="form-group">
	<label for="tanggal_terdaftar" class="col-sm-3 control-label">Tanggal Mulai Terdaftar</label>
	<div class="col-sm-4">
		<div class="input-group input-group-sm date">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			<input type="text" class="form-control input-sm pull-right required" id="tanggal_terdaftar" name="tanggal_terdaftar" value="<?= $tanggal_terdaftar ?>">
		</div>
	</div>
</div>
<div class="form-group">
	<label for="nama_puskesmas" class="col-sm-3 control-label">Nama Puskesmas - Posyandu</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" name="nama_puskesmas" id="nama_puskesmas" value="<?= $nama_puskesmas ?>" placeholder="Nama Puskesmas">
	</div>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" name="nama_posyandu" id="nama_posyandu" value="<?= $nama_posyandu ?>" placeholder="Nama Posyandu">
	</div>
</div>
<!--
<div class="form-group">
	<div class="col-sm-4">
		<input class="form-control input-sm number" type="text" name="durasi_pemudik" id="durasi_pemudik" value="<?= $durasi_mudik ?>" placeholder="Jumlah Hari (angka)">
	</div>
</div>
-->

<div class="form-group">
	<label for="hp_ortu" class="col-sm-3 control-label">Kontak Orang Tua/Wali (No HP - Email)</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" name="hp_ortu" id="hp_ortu" value="<?= $hp_ortu ?>" placeholder="No HP">
	</div>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" name="email_ortu" id="email_ortu" value="<?= $email_ortu ?>" placeholder="Email Orang Tua / Wali">
	</div>
</div>
<div class="form-group">
	<label for="tb_lahir" class="col-sm-3 control-label">BB - TB Lahir</label>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" name="bb_lahir" id="bb_lahir" value="<?= $bb_lahir ?>" placeholder="BB Lahir (Kg)">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" name="tb_lahir" id="tb_lahir" value="<?= $tb_lahir ?>" placeholder="TB Lahir (Cm)">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="wajib_pantau">Apakah Balita Wajib Dipantau Tumbuh Kembangnya?</label>
	<div class="col-sm-2">
		<select class="form-control input-sm" name="wajib_pantau" id="wajib_pantau">
			<option value="1" <?php selected($is_wajib_pantau, '1'); ?>>Ya</option>
			<option value="0" <?php selected($is_wajib_pantau, '0'); ?>>Tidak</option>
		</select>
	</div>
	<div class="col-sm-5">
		<span id="wajib_pantau_plus_msg" class="help-block">
			<code>Jika ya, Data Balita akan masuk dalam daftar Pemantauan Balita.</code>
		</span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="riwayat_penyakit">Riwayat Penyakit</label>
	<div class="col-sm-8">
		<textarea name="riwayat_penyakit" id="riwayat_penyakit" class="form-control input-sm" placeholder="Riwayat Penyakit" rows="3" style="resize:none;"><?= $riwayat_penyakit ?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
	<div class="col-sm-8">
		<textarea name="keterangan" id="keterangan" class="form-control input-sm" placeholder="Keterangan" rows="3" style="resize:none;"><?= $keterangan ?></textarea>
	</div>
</div>