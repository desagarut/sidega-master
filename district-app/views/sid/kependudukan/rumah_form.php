<style type="text/css">
	#rumah_penduduk label {
		padding-left: 10px;
	}
</style>

<script src="<?= base_url()?>assets/js/validasi.js"></script>
<script>
$(document).ready(function() {
	$('#file_browser').click(function(e)
	{
		e.preventDefault();
		$('#file').click();
	});

	$('#file').change(function()
	{
		$('#file_path').val($(this).val());
	});

	$('#file_path').click(function()
	{
		$('#file_browser').click();
	});
});

</script>
<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data">
	<div class='modal-body'>
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-body">
						<div class="form-group">
							<label for="nama">Nama Rumah</label>
							<input id="nama" name="nama" class="form-control" type="text" placeholder="Nama Rumah" value="<?= $rumah['nama']?>"></input>	<input type="hidden" name="id_pend" value="<?= $penduduk['id']?>"/>
						</div>
						<div class="form-group">
							<label for="file" >Pilih File:</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" id="file_path" name="satuan">
								<input type="file" class="hidden" id="file" name="satuan">
								<input type="hidden" name="old_file" value="<?= $rumah['satuan']?>">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-box"  id="file_browser"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
							<p class="help-block">Kosongkan jika tidak ingin mengubah dokumen.<br/>
                            Batas maksimal pengunggahan berkas <strong><?= max_upload() ?> MB.</strong></p>
						</div>
						<div class="form-group" id="rumah_penduduk">
							<div class="input-group input-group-sm">
								<input type="checkbox" name="rumah_penduduk" <?php jecho($dokumen['rumah_penduduk'], 1, 'checked')?>>
								<label>Boleh diubah oleh warga melalui Layanan Mandiri</label>
							</div>
						</div>
						<?php if (!empty($kk)): ?>
							<hr>
							<p><strong>Centang jika dokumen yang diupload berlaku juga untuk anggota keluarga di bawah ini. </strong></p>
							<div class="table-responsive">
								<table class="table table-bordered table-hover table-striped table-sm">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">NIK</th>
											<th scope="col">Nama</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($kk as $item): ?>
											<?php if ($item['nik'] != $penduduk['nik']): ?>
												<tr>
													<td><input type='checkbox' name='anggota_kk[]' value="<?=$item['id']?>" <?=$item['checked']?> /></td>
													<td><?=$item['nik']?></td>
													<td><?=$item['nama']?></td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
		<button type="submit" class="btn btn-social btn-box btn-info btn-sm" id="ok"><i class='fa fa-check'></i> Simpan</button>
	</div>
</form>
