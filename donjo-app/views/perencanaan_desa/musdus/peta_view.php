<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>
<script>
<?php if (!empty($data['lat'] && !empty($data['lng']))): ?>
	var center = { lat: <?= $data['lat'].", lng: ".$data['lng']; ?> };
<?php else: ?>
	var center = { lat: <?= $desa['lat'].", lng: ".$desa['lng']; ?> };
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
			title: "<?=$data['nama_program_kegiatan']?>"
	});

	marker.addListener('dragend', (e) => {
		document.getElementById('lat').value = e.latLng.lat();
		document.getElementById('lng').value = e.latLng.lng();
	})
}
</script>
<style>
#map_lokasi {
	z-index: 1;
	width: 100%;
	height: 400px;
	border: 1px solid #000;
	margin-top: auto;
}
</style>

          <div class='modal-body'>
            <div class="row">
              <div class="col-sm-12">
                <div id="map_lokasi"></div>
              </div>
            </div>
          </div>
