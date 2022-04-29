<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>

<script>
<?php if (!empty($penduduk['lat'] && !empty($penduduk['lng']))): ?>
	var center = { lat: <?= $penduduk['lat'].", lng: ".$penduduk['lng']; ?> };
<?php else: ?>
	var center = { lat: <?=$desa['lat'].", lng: ".$desa['lng']?> };
<?php endif; ?>

function initMap() {
	var myLatlng = new google.maps.LatLng(center.lat, center.lng);
	var mapOptions = { zoom: 17, center, mapTypeId:google.maps.MapTypeId.HYBRID }
	var map = new google.maps.Map(document.getElementById("map_penduduk"), mapOptions);
	
	// Place a draggable marker on the map
	var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: true,
			title: "Lokasi Rumah <?=$penduduk['nama']?>"
	});

	marker.addListener('dragend', (e) => {
		document.getElementById('lat').value = e.latLng.lat();
		document.getElementById('lng').value = e.latLng.lng();
	})
	marker.addListener("click", () => {
    map.setZoom(19);
    map.setCenter(marker.getPosition());
  });
}
</script>
<style>
  #map_penduduk
  {
	z-index: 1;
    width: 100%;
    height: 400px;
    border: none;
	margin-top:auto;
  }
</style>
<form id="validasi1" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">	
<div class='modal-body'>
		<div class="row">
			<div class="col-sm-12">
				<div id="map_penduduk"></div>
				<input type="hidden" name="lat" id="lat" value="<?= $penduduk['lat']?>"/>
                <input type="hidden" name="lng" id="lng" value="<?= $penduduk['lng']?>" />
			</div>
		</div>
	<div class="modal-footer">
        <div class='col-xs-12'>
            <button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
            <button type="submit" class="btn btn-social btn-box btn-success btn-sm"><i class='fa fa-check'></i> Simpan</button>
		</div>
    </div>
</form>