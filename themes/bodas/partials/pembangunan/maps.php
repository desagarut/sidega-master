<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOKTzsvtw8j-TJI8dmJ228bXASq4C-S7U&callback=initMap&v=weekly" defer></script>

<script>
	<?php if (!empty($detail_pembangunan['lat'] && !empty($detail_pembangunan['lng']))) : ?>
		var center = {
			lat: <?= $detail_pembangunan['lat'] . ", lng: " . $detail_pembangunan['lng']; ?>
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
			center,
			mapTypeId: google.maps.MapTypeId.HYBRID
		}
		var map = new google.maps.Map(document.getElementById("map_lokasi"), mapOptions);

		// Place a draggable marker on the map
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: false,
			title: '<?= $detail_pembangunan['nama_program_kegiatan'] ?>',
			content: "Lokasi Program/Kegiatan",
		});

		var infowindow = new google.maps.InfoWindow({
			content: "<div class='media text-center'> <?php if (is_file(LOKASI_GALERI . $detail_pembangunan['foto'])) : ?><img src='<?= base_url() . LOKASI_GALERI . $detail_pembangunan['foto'] ?>' width='150px' height='100px'><?php else : ?><img src='<?= base_url() ?>themes/bodas/assets/img/noimage.png' width='150px' height='100px'><?php endif; ?><br/> <p class='container mt-2'>Lokasi <?= strtolower($detail_pembangunan['nama_program_kegiatan']) ?></p></div>",
			title: '<?= $pembangunan->nama_program_kegiatan ?>',
		});
		infowindow.open(map, marker);

		marker.addListener('dragend', (e) => {
			document.getElementById('lat').value = e.latLng.lat();
			document.getElementById('lng').value = e.latLng.lng();
		});

	}
</script>
<style>
	#map_lokasi {
		z-index: 1;
		width: 100%;
		height: 320px;
	}
</style>

<div class="col-sm-12">
	<div id="map_lokasi"></div>
</div>