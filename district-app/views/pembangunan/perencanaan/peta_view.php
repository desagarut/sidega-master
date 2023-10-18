<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOKTzsvtw8j-TJI8dmJ228bXASq4C-S7U&callback=initMap&v=weekly" defer></script>

<script>
	<?php if (!empty($musdus->lat && !empty($musdus->lng))) : ?>
		var center = {
			lat: <?= $musdus->lat . ", lng: " . $musdus->lng; ?>
		};
	<?php else : ?>
		var center = {
			lat: <?= $desa['lat'] . ", lng: " . $desa['lng']; ?>
		};
	<?php endif; ?>

	function initMap() {
		var myLatlng = new google.maps.LatLng(center.lat, center.lng);
		var mapOptions = {
			zoom: 17,
			center
		}
		var map = new google.maps.Map(document.getElementById("map_lokasi"), mapOptions);

		// Place a draggable marker on the map
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: true,
			title: '<?= $musdus->nama_program_kegiatan ?>',
			content: "Tampilan Info Window",
			//icon: iconBase + '<?= base_url() . LOKASI_GALERI . $musdus->foto ?>'
		});

		marker.addListener('dragend', (e) => {
			document.getElementById('lat').value = e.latLng.lat();
			document.getElementById('lng').value = e.latLng.lng();
		});

		var infowindow = new google.maps.InfoWindow({
			content: "<div class='media text-center'><img src='<?= base_url() . LOKASI_GALERI . $musdus->foto ?>' width='150px' height='100px'><br/> <p>Lokasi Kegiatan</p></div>"
		});
		infowindow.open(map, marker);
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