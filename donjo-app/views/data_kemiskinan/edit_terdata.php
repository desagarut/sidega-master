<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<form action="<?= $form_action; ?>" method="post" id="validasi" enctype="multipart/form-data">
	<div class='modal-body'>
		<table class="table table-bordered table-striped table-hover table-rincian">
			<tbody>
				<tr>
					<td width="20%"><?= $judul_terdata_nama; ?></td>
					<td width="1">:</td>
					<td><?= $terdata_nama; ?></td>
				</tr>
				<tr>
					<td><?= $judul_terdata_info; ?></td>
					<td>:</td>
					<td><?= $terdata_info; ?></td>
				</tr>
			</tbody>
		</table>
		<div class="form-group">
			<label for="id_dtks">ID DTKS</label>
			<input name="id_dtks" id="id_dtks" class="form-control input-sm" maxlength="100" placeholder="ID DTKS"><?= $id_dtks?></input>
		</div>
		<div class="form-group">
			<label for="keterangan_padan">Keterangan Padan</label>
			<input name="keterangan_padan" id="keterangan_padan" class="form-control input-sm" maxlength="100" placeholder="Keterangan Padan"><?= $keterangan_padan?></input>
		</div>

		<div class="form-group">
			<label for="keterangan_bantuan">Keterangan Bantuan</label>
			<input type="hidden" name="id_data_kemiskinan" value="<?= $id_data_kemiskinan?>"/>
			<textarea name="keterangan_bantuan" id="keterangan_bantuan" class="form-control input-sm" maxlength="100" placeholder="Keterangan Bantuan" rows="5"><?= $keterangan_bantuan?></textarea>
		</div>

	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-social btn-box btn-danger btn-sm pull-left"><i class="fa fa-times"></i> Batal</button>
		<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class='fa fa-check'></i> Simpan</button>
	</div>
</form>
