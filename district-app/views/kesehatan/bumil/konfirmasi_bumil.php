<div class="form-group">
	<label for="foto" class="col-sm-3 control-label">Foto</label>
	<div class="col-sm-4">
		<img class="img img-circle" style="with:100px; height:100px" src="<?= AmbilFoto($individu['foto'], '', $individu['id_sex']) ?>" alt="foto <?= strtoupper($individu['nama']); ?>" title="foto <?= strtoupper($individu['nama']); ?>" />
	</div>
</div>

<div class="form-group">
	<label for="keperluan"  class="col-sm-3 control-label">Tempat  Tanggal Lahir / Umur</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= $individu['tempatlahir']?>" disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value="<?= tgl_indo($individu['tanggallahir'])?>" disabled="">
	</div>
	<div class="col-sm-2">
		<input class="form-control input-sm" type="text" value="<?= $individu['umur']?> Tahun" disabled="">
	</div>
</div>
<div class="form-group">
	<label for="keperluan"  class="col-sm-3 control-label">Alamat</label>
	<div class="col-sm-8">
		<input class="form-control input-sm" type="text" value="<?= $individu['alamat_wilayah']; ?>" disabled="">
	</div>
</div>
<div class="form-group">
	<label for="keperluan"  class="col-sm-3 control-label">Pendidikan</label>
	<div class="col-sm-8">
		<input class="form-control input-sm" type="text" value="<?= $individu['pendidikan']?>" disabled="">
	</div>
</div>
<div class="form-group">
	<label for="keperluan"  class="col-sm-3 control-label">Warga Negara /Agama</label>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= $individu['warganegara']?>" disabled="">
	</div>
	<div class="col-sm-4">
		<input class="form-control input-sm" type="text" value="<?= $individu['agama']?>" disabled="">
	</div>
</div>