<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>

<script>
<?php if (!empty($wil_ini['lat'] && !empty($wil_ini['lng']))): ?>
	var center = { lat: <?= $wil_ini['lat'].", lng: ".$wil_ini['lng']; ?> };
<?php else: ?>
	var center = { lat: <?=$desa['lat'].", lng: ".$desa['lng']?> };
<?php endif; ?>

function initMap() {
	var myLatlng = new google.maps.LatLng(center.lat, center.lng);
	var mapOptions = { zoom: 17, center }
	var map = new google.maps.Map(document.getElementById("map_desa"), mapOptions);

	// Place a draggable marker on the map
	var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: false,
			title: "<?=$wilayah['nama_desa']?>"
	});

	marker.addListener('dragend', (e) => {
		document.getElementById('lat').value = e.latLng.lat();
		document.getElementById('lng').value = e.latLng.lng();
	})
}
</script>
<style>
  #map_desa
  {
	z-index: 1;
    width: 100%;
    height: 400px;
    border: 1px solid #F90;
  }
</style>
<div>
    <div id="map_desa"></div>
    <input type="hidden" name="lat" id="lat" value="<?= $wil_ini['lat']?>"/>
    <input type="hidden" name="lng" id="lng" value="<?= $wil_ini['lng']?>" />
</div>
	

