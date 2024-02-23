<div class='modal-body'>
	<div class="row">
		<div class="col-md-12">
			<form id="validasi1" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="lat">Latitude</label>
								<div class="col-sm-9">

									<input class="form-control number" name="lat" id="lat" value="<?= $lokasi['lat'] ?>" />

								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="lng">Longitude</label>
								<div class="col-sm-9">

									<input class="form-control number" name="lng" id="lng" value="<?= $lokasi['lng']; ?>" />

								</div>
							</div>

							<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right' id="simpan_lokasi"><i class='fa fa-check'></i> Simpan</button>

						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>