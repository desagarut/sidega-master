<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>

<script>
<?php if (!empty($lokasi['lat'] && !empty($lokasi['lng']))): ?>
	var center = { lat: <?= $lokasi['lat'].", lng: ".$lokasi['lng']; ?> };
<?php else: ?>
	var center = { lat: <?=$desa['lat'].", lng: ".$desa['lng']?> };
<?php endif; ?>

function initMap() {
	var myLatlng = new google.maps.LatLng(center.lat, center.lng);
	var mapOptions = { zoom: 17, center }
	var map = new google.maps.Map(document.getElementById("map_lokasi"), mapOptions);

	// Place a draggable marker on the map
	var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: true,
			title: "<?=$lokasi['nama']?>"
	});

	marker.addListener('dragend', (e) => {
		document.getElementById('lat').value = e.latLng.lat();
		document.getElementById('lng').value = e.latLng.lng();
	})
}
</script>
<style>
  #map_lokasi
  {
	z-index: 1;
    width: 100%;
    height: 450px;
    border: 1px solid #000;
	margin-top:auto;
  }
</style>

<div class="content-wrapper">

	<section class="content-header">
		<h1>Lokasi <?= $lokasi['nama']?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('plan')?>"> Pengaturan Lokasi</a></li>
			<li class="active">Lokasi <?= $lokasi['nama']?></li>
		</ol>
	</section>

<form action="<?= $form_action?>" method="post" id="validasi">
	<div class='modal-body'>
		<div class="row">
			<div class="col-sm-12">
				<div id="map_lokasi"></div>
				<input type="hidden" name="lat" id="lat" value="<?= $lokasi['lat']?>"/>
                <input type="hidden" name="lng" id="lng" value="<?= $lokasi['lng']?>" />
			</div>
		</div>
	</div>
	<div class="modal-footer">
        <div class='col-xs-12'>
            <a href="<?= site_url('plan')?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
            <a href="#" class="btn btn-social btn-box btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" download="SIDeGa.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>
            <button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
            <button type="submit" class="btn btn-social btn-box btn-info btn-sm"><i class='fa fa-check'></i> Simpan</button>
		</div>
    </div>
    
    
</form>
</div>

