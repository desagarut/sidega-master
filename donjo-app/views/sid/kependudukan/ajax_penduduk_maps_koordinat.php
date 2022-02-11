<style type="text/css">
	#koordinat_penduduk label {
		padding-left: 10px;
	}
</style>


<div class='modal-body'>
		<div class="row">
			<div class="col-md-12">
					<form id="validasi1" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="lat">Latitude</label>
									<div class="col-sm-9">
										<?php switch ($edit): ?><?php case '0': ?>
											<input readonly="readonly" class="form-control number" name="lat1" id="lat1" value="<?= $penduduk['lat']; ?>"/>
											<?php break; ?>
										<?php case '1': ?>
											<input type="text" class="form-control number" name="lat" id="lat" value="<?= $penduduk['lat']; ?>"/>
											<?php break; ?>
										<?php case '2': ?>
											<input type="text" class="form-control number" name="lat" id="lat" value="<?= $penduduk['lat']; ?>"/>
											<?php break; ?>
										<?php endswitch ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="lng">Longitude</label>
									<div class="col-sm-9">
										<?php switch ($edit): ?><?php case '0': ?>
											<input readonly="readonly" class="form-control number" name="lng1" id="lng1" value="<?= $penduduk['lng']; ?>"/>
											<?php break; ?>
										<?php case '1': ?>
											<input type="text" class="form-control number" name="lng" id="lng" value="<?= $penduduk['lng']; ?>"/>
											<?php break; ?>
										<?php case '2': ?>
											<input type="text" class="form-control number" name="lng" id="lng" value="<?= $penduduk['lng']; ?>"/>
											<?php break; ?>
										<?php endswitch ?>
									</div>
								</div>

                                <button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right' id="simpan_penduduk"><i class='fa fa-check'></i> Simpan</button>

							</div>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#simpan_penduduk').click(function(){

			$("#validasi1").validate({
				errorElement: "label",
				errorClass: "error",
				highlight:function (element){
					$(element).closest(".form-group").addClass("has-error");
				},
				unhighlight:function (element){
					$(element).closest(".form-group").removeClass("has-error");
				},
				errorPlacement: function (error, element) {
					if (element.parent('.input-group').length) {
						error.insertAfter(element.parent());
					} else {
						error.insertAfter(element);
					}
				}
			});

			if (!$('#validasi1').valid()) return;

			var id = $('#id').val();
			var lat = $('#lat').val();
			var lng = $('#lng').val();

			$.ajax({
				type: "POST",
				url: "<?=$form_action?>",
				dataType: 'json',
				data: {lat: lat, lng: lng, id: id},
			});
		});
	});
</script>
