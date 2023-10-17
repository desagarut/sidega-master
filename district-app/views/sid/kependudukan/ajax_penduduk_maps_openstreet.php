<script>
var infoWindow;
window.onload = function()
{
	//Jika posisi kantor dusun belum ada, maka posisi peta akan menampilkan peta desa
	<?php if (!empty($penduduk['lat'])):	?>
		var posisi = [<?= $penduduk['lat'].",".$penduduk['lng']; ?>];
		var zoom = <?= $desa['zoom'] ?: 10; ?>;
	<?php else: ?>
		var posisi = [<?= $desa['lat'].",".$desa['lng']; ?>];
		var zoom = 10;
	<?php	endif; ?>

	//Inisialisasi tampilan peta
	var peta_penduduk = L.map('mapx').setView(posisi, zoom);

	//1. Menampilkan overlayLayers Peta Semua Wilayah
	var marker_desa = [];
	var marker_dusun = [];
	var marker_rw = [];
	var marker_rt = [];

	//WILAYAH DESA
	<?php if (!empty($desa['path'])): ?>
    set_marker_desa(marker_desa, <?=json_encode($desa)?>, "<?=ucwords($this->setting->sebutan_desa).' '.$desa['nama_desa']?>", "<?= favico_desa()?>");
	<?php endif; ?>

	//WILAYAH DUSUN
	<?php if (!empty($dusun_gis)): ?>
		set_marker(marker_dusun, '<?=addslashes(json_encode($dusun_gis))?>', '<?=ucwords($this->setting->sebutan_dusun)?>', 'dusun', "<?= favico_desa()?>");
	<?php endif; ?>

	//OVERLAY WILAYAH RW
	<?php if (!empty($rw_gis)): ?>
		set_marker(marker_rw, '<?=addslashes(json_encode($rw_gis))?>', 'RW', 'rw', "<?= favico_desa()?>");
	<?php endif; ?>

	//OVERLAY WILAYAH RT
	<?php if (!empty($rt_gis)): ?>
		set_marker(marker_rt, '<?=addslashes(json_encode($rt_gis))?>', 'RT', 'rt', "<?= favico_desa()?>");
	<?php endif; ?>

	//2. Menampilkan overlayLayers Peta Semua Wilayah
  <?php if (!empty($wil_atas['path'])): ?>
    var overlayLayers = overlayWil(marker_desa, marker_dusun, marker_rw, marker_rt, "<?=ucwords($this->setting->sebutan_desa)?>", "<?=ucwords($this->setting->sebutan_dusun)?>");
  <?php else: ?>
    var overlayLayers = {};
  <?php endif; ?>

	//Menampilkan BaseLayers Peta
  var baseLayers = getBaseLayers(peta_penduduk, '<?=$this->setting->google_key?>');

	//Menampilkan dan Menambahkan Peta wilayah + Geolocation GPS + Exim GPX/KML
	L.Control.FileLayerLoad.LABEL = '<img class="icon" src="<?= base_url()?>assets/images/folder.svg" alt="file icon"/>';
	showCurrentPoint(posisi, peta_penduduk);

	//Menambahkan zoom scale ke peta
	L.control.scale().addTo(peta_penduduk);

	L.control.layers(baseLayers, overlayLayers, {position: 'topleft', collapsed: true}).addTo(peta_penduduk);

}; //EOF window.onload
</script>
<style>
	#mapx
	{
		width:100%;
		height:45vh
	}
	.icon {
		max-width: 70%;
		max-height: 70%;
		margin: 4px;
	}
	.leaflet-control-layers {
		display: block;
		position: relative;
	}
	.leaflet-control-locate a {
	font-size: 2em;
	}
</style>
<!-- Menampilkan OpenStreetMap dalam Box modal bootstrap (AdminLTE)  -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Lokasi Tempat Tinggal <?= $penduduk['nama']?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<?php switch ($edit): ?><?php case '0': ?>
			<?php case '2': ?>
				<li><a href="<?= site_url("penduduk")?>"> Daftar Penduduk</a></li>
				<?php break; ?>
			<?php case '1': ?>
				<li><a href="<?= site_url("penduduk/form/$p/$o/$id/1")?>"> Biodata Penduduk</a></li>
				<li><a href=#> Lokasi Tempat Tinggal</a></li>
				<?php break; ?>
			<?php endswitch ?>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<form id="validasi1" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div id="mapx">
									</div>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
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
								<div class="pull-right">
								<?php switch ($edit): ?><?php case '0': ?>
									<a href="<?=site_url("penduduk")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
									<a href="<?=site_url("penduduk/ajax_penduduk_maps/$p/$o/$id/2")?>" class="btn btn-social btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Ubah"><i class="fa fa-edit"></i> Ubah</a>
									<?php break; ?>
								<?php case '1': ?>
									<a href="<?=site_url("penduduk/detail/$p/$o/$id/1")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
									<a href="#" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" download="SIDeGa.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>
                                    <a href="<?=site_url("penduduk/ajax_penduduk_maps_google/$p/$o/$penduduk[id]/1")?>" title="Lokasi <?= $penduduk['nama']?>" class="btn btn-social btn-box bg-aqua btn-sm" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Lokasi Rumah"><i class='fa fa-google'></i> Ubah di GoogleMap</a> 
									<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' id="resetme"><i class='fa fa-times'></i> Reset</button>
                                    
									<?php if ($penduduk['status_dasar'] == 1 || !isset($penduduk['status_dasar'])): ?>
										<button type='submit' class='btn btn-social btn-box btn-success btn-sm' id="simpan_penduduk"><i class='fa fa-check'></i> Simpan</button>
									<?php endif; ?>
									<?php break; ?>
								<?php case '2': ?>
									<a href="<?=site_url("penduduk")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
									<a href="#" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" download="SIDeGa.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>
                                    <a href="<?=site_url("penduduk/ajax_penduduk_maps_google/$p/$o/$penduduk[id]/1")?>" title="Lokasi <?= $penduduk['nama']?>" class="btn btn-social btn-box bg-aqua btn-sm" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Lokasi Rumah"><i class='fa fa-google'></i> Ubah di GoogleMap</a> 
									<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' id="resetme"><i class='fa fa-times'></i> Reset</button>
									<?php if ($penduduk['status_dasar'] == 1 || !isset($penduduk['status_dasar'])): ?>
										<button type='submit' class='btn btn-social btn-box btn-success btn-sm' id="simpan_penduduk"><i class='fa fa-check'></i> Simpan</button>
									<?php endif; ?>
									<?php break; ?>
								<?php endswitch ?>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
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

<script src="<?= base_url()?>assets/js/leaflet.filelayer.js"></script>
<script src="<?= base_url()?>assets/js/togeojson.js"></script>
