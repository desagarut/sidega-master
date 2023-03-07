<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="<?= base_url()?>assets/js/mapsJavaScriptAPI.js"></script>

<script>
<?php if (!empty($sub['lat'] && !empty($sub['lng']))): ?>
	var center = { lat: <?= $sub['lat'].", lng: ".$sub['lng']; ?> };
<?php else: ?>
	var center = { lat: <?=$desa['lat'].", lng: ".$desa['lng']?> };
<?php endif; ?>

function initMap() {
	var myLatlng = new google.maps.LatLng(center.lat, center.lng);
	var mapOptions = { zoom: 17, center, mapTypeId:google.maps.MapTypeId.HYBRID }
	var map = new google.maps.Map(document.getElementById("map"), mapOptions);
	
	// Place a draggable marker on the map
	var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: true,
			title: "Lokasi <?=$sub['nama']?>"
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
#map {
	z-index: 1;
	width: 100%;
	height: 200px;
	border: none;
	margin-top: auto;
}
</style>

<div class="col-sm-12">
  <div id="map"></div>
</div>