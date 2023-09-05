<?php defined('BASEPATH') || exit('No direct script access allowed');?>

<?php if ($list_tahun): ?>
	<div class="form-group">
		<label for="tahun">Tahun Anggaran</label>
		<select class="form-control input-sm" name="tahun">
			<option value="semua">Semua Tahun</option>
			<?php foreach ($list_tahun as $list): ?>
				<option value="<?= $list->tahun; ?>" <?= selected($tahun, $list->tahun); ?>><?= $list->tahun; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
<?php endif; ?>

<div class="form-group">
	<label for="tgl_cetak">Tanggal Cetak</label>
	<div class="input-group input-group-sm date">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input class="form-control input-sm pull-right required" id="tgl_1" name="tgl_cetak" type="text" value="<?= date('d-m-Y'); ?>">
	</div>
</div>