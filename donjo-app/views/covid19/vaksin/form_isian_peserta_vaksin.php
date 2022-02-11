<script type="text/javascript">
	$(document).ready(function()
	{
		//https://momentjs.com/docs/#/parsing/string-format/
		$('#tanggal').datetimepicker(
		{
			format: 'YYYY-MM-DD'
		});
	});
</script>

<div class="form-group">
	<label for="asal_pemudik" class="col-sm-3 control-label">Keterangan Tanggal </label>
	<div class="col-sm-4">
		<div class="input-group input-group-sm date">
			<div class="input-group-addon">
		        <i class="fa fa-calendar"></i>
		    </div>
		    <input type="text" class="form-control input-sm pull-right required" id="tanggal" name="tanggal" value="<?= $tanggal?>">
	    </div>
	</div>
</div>

<div class="form-group">
	<label  class="col-sm-3 control-label" for="pokmas">Kelompok Masyarakat</label>
	<div class="col-sm-4">
		 <select class="form-control input-sm" name="pokmas" id="pokmas">
			<option value="REMAJA" <?php selected($pokmas, 'REMAJA'); ?> >REMAJA</option>
			<option value="MASYARAKAT UMUM" <?php selected($pokmas, 'MASYARAKAT UMUM'); ?> >MASYARAKAT UMUM</option>
			<option value="PRA LANSIA" <?php selected($pokmas, 'PRA LANSIA'); ?> >PRA LANSIA</option>
			<option value="LANSIA" <?php selected($pokmas, 'LANSIA'); ?> >LANSIA</option>
		</select>
	 </div>
</div>

<div class="form-group">
	<label for="hp_pemudik" class="col-sm-3 control-label">Kontak Penerima Vaksin</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" name="no_hp" id="no_hp" value="<?= $no_hp?>" placeholder="No HP">
	</div>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" name="email" id="email" value="<?= $email?>" placeholder="Email">
	</div>
</div>

<div class="form-group">
	<label  class="col-sm-3 control-label" for="dosis1">Centang jika Sudah di Vaksin:</label>
	<div class="col-sm-2">
                    <input type="checkbox" class="form-check-input" name="dosis1"> Dosis 1
                    </div>
</div>
<div class="form-group">
	<label  class="col-sm-3 control-label" for="dosis2">Centang jika Sudah di Vaksin:</label>
	<div class="col-sm-2">
                    <input type="checkbox" class="form-check-input" name="dosis2"> Dosis 2
	</div>
</div>
<!--
<div class="form-group">
	<label for="jenis_vaksin" class="col-sm-3 control-label">Jenis Vaksin </label>
	<div class="col-sm-2">
		<select class="form-control input-sm" name="jenis_vaksin" id="jenis_vaksin">
			<option value="">-- Pilih Jenis Vaksin --</option>
			<?php foreach ($select_jenis_vaksin as $id => $nama): ?>
			<option value="<?= $id?>" <?php selected($jenis_vaksin, $nama); ?> > <?= strtoupper($nama)?> </option>
			<?php endforeach;?>
		</select>
	</div>
	<div class="col-sm-2">
		<select class="form-control input-sm" name="jenis_vaksin2" id="jenis_vaksin2">
			<option value="">-- Pilih Jenis Vaksin --</option>
			<?php foreach ($select_jenis_vaksin as $id => $nama): ?>
			<option value="<?= $id?>" <?php selected($jenis_vaksin, $nama); ?> > <?= strtoupper($nama)?> </option>
			<?php endforeach;?>
		</select>
	</div>
</div>
-->

<div class="form-group">
	<label  class="col-sm-3 control-label" for="jenis_vaksin">Jenis Vaksin</label>
	<div class="col-sm-2">
		 <select class="form-control input-sm" name="jenis_vaksin" id="jenis_vaksin">
			<option value="SINOVAC" <?php selected($jenis_vaksin, 'SINOVAC'); ?> >SINOVAC</option>
			<option value="ASTRAZENECA" <?php selected($jenis_vaksin, 'ASTRAZENECA'); ?> >ASTRAZENECA</option>
			<option value="SINOPHARM" <?php selected($jenis_vaksin, 'SINOPHARM'); ?> >SINOPHARM</option>
			<option value="MODERNA" <?php selected($jenis_vaksin, 'MODERNA'); ?> >MODERNA</option>
			<option value="PFIZER" <?php selected($jenis_vaksin, 'PFIZER'); ?> >PFIZER</option>
			<option value="NOVAVAX" <?php selected($jenis_vaksin, 'NOVAVAX'); ?> >NOVAVAX</option>
			<option value="SPUTNIK-V" <?php selected($jenis_vaksin, 'SPUTNIK-V'); ?> >SPUTNIK-V</option>
			<option value="JANSEN" <?php selected($jenis_vaksin, 'JANSEN'); ?> >JANSEN</option>
			<option value="CONVIDENCIA" <?php selected($jenis_vaksin, 'CONVIDENCIA'); ?> >CONVIDENCIA</option>
			<option value="ZIFIVAK" <?php selected($jenis_vaksin, 'ZIFIVAK'); ?> >ZIFIVAK</option>
		</select>
	 </div><!--
	<div class="col-sm-2">
		 <select class="form-control input-sm" name="jenis_vaksin2" id="jenis_vaksin2">
			<option value="SINOVAC" <?php selected($pokmas, 'SINOVAC'); ?> >SINOVAC</option>
			<option value="ASTRAZENECA" <?php selected($pokmas, 'ASTRAZENECA'); ?> >ASTRAZENECA</option>
			<option value="SINOPHARM" <?php selected($pokmas, 'SINOPHARM'); ?> >SINOPHARM</option>
			<option value="MODERNA" <?php selected($pokmas, 'MODERNA'); ?> >MODERNA</option>
			<option value="PFIZER" <?php selected($pokmas, 'PFIZER'); ?> >PFIZER</option>
			<option value="NOVAVAX" <?php selected($pokmas, 'NOVAVAX'); ?> >NOVAVAX</option>
			<option value="SPUTNIK-V" <?php selected($pokmas, 'SPUTNIK-V'); ?> >SPUTNIK-V</option>
			<option value="JANSEN" <?php selected($pokmas, 'JANSEN'); ?> >JANSEN</option>
			<option value="CONVIDENCIA" <?php selected($pokmas, 'CONVIDENCIA'); ?> >CONVIDENCIA</option>
			<option value="ZIFIVAK" <?php selected($pokmas, 'ZIFIVAK'); ?> >ZIFIVAK</option>
		</select>
	 </div>-->
</div>

<div class="form-group">
	<label  class="col-sm-3 control-label" for="is_wajib_pantau">Apakah Wajib Dipantau?</label>
	<div class="col-sm-8">
		 <select class="form-control input-sm" name="is_wajib_pantau" id="is_wajib_pantau">
			<option value="1" <?php selected($is_wajib_pantau, '1'); ?> >Ya</option>
			<option value="0" <?php selected($is_wajib_pantau, '0'); ?> >Tidak</option>
		</select>
		<span id="wajib_pantau_plus_msg" class="help-block">
			<code>Jika ya, daftar warga ini masuk dalam daftar warga yang dipantau di menu Pemantauan</code>
		</span>
	 </div>
</div>
<div class="form-group">
	<label  class="col-sm-3 control-label" for="kipi">Kejadian Ikutan Pasca Imunisasi (KIPI)</label>
	<div class="col-sm-8">
		 <textarea name="kipi" id="kipi" class="form-control input-sm" placeholder="Jika ada Kejadian Ikutan Pasca Imunisasi tulis di sini" rows="3" style="resize:none;"><?= $kipi?></textarea>
	 </div>
</div>

<div class="form-group">
	<label  class="col-sm-3 control-label" for="keterangan">Keterangan</label>
	<div class="col-sm-8">
		 <textarea name="keterangan" id="keterangan" class="form-control input-sm" placeholder="Keterangan" rows="3" style="resize:none;"><?= $keterangan?></textarea>
	 </div>
</div>