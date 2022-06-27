<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>
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
	height: 390px;
	border: none;
	margin-top: auto;
}
</style>

<div class="col-sm-12">
  <div id="map"></div>
  <div class="col-lg-12 col-md-4 mt-1">
    <div class="icon-box" style="padding-top: 20px;">
	<marquee behavior="alternate" scrollamount="1">
      <a href="<?= site_url('first/toko_show') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/toko.png" ) ?>" width="70px" /> </a> 
	  <a href="<?= site_url('first/tukang') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/tukang.png" ) ?>" width="70px" /> </a> 
	  <a href="<?= site_url('first/tawa') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/transport.png" ) ?>" width="70px" /> </a> 
	  <a href="<?= site_url('first/wisata') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/wisata.png" ) ?>" width="70px" /> </a>
      <a href="https://www.google.com/maps/place/@<?=$sub['lat']?>,<?=$sub['lng']?>,20z" target="_blank"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/gmap.png")?>" width="60px" /> </a>
	</marquee>
    </div>
  </div>
</div>