<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsKE9ArOZcaNtsfXIMFqr4N-UCsmp-Ng&callback=initMap">
</script>
<script>
<?php if (!empty($sub['lat'] && !empty($sub['lng']))): ?>
	var center = { lat: <?= $sub['lat'].", lng: ".$sub['lng']; ?> };
<?php else: ?>
	var center = { lat: <?=$desa['lat'].", lng: ".$desa['lng']?> };
<?php endif; ?>

function initMap() {
	var myLatlng = new google.maps.LatLng(center.lat, center.lng);
	var mapOptions = { zoom: 18, center, mapTypeId:google.maps.MapTypeId.HYBRID }
	var map = new google.maps.Map(document.getElementById("map_penduduk"), mapOptions);
	
	// Place a draggable marker on the map
	var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			draggable: false,
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
#map_penduduk {
	z-index: 1;
	width: 100%;
	height: 400px;
	border: none;
	margin-top: auto;
}
</style>

<div class="col-sm-3">
  <div class="box box-warning">
    <div class="box-body box-profile"> <img class="img-responsive img-circle" src=<?= AmbilGaleri($sub['gambar'], 'kecil') ?>>
      <h3 class="profile-username text-center">
        <?= strtoupper($sub['nama'])?>
      </h3>
      <ul class="list-group list-group-unbordered" >
        <li class="list-group-item"> Pengelola <a class="pull-right">
          <?= $sub['nama_pengelola']?>
          </a> </li>
          
      </ul><a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20produk%20anda%20yang%20ditawarkan%20di%20website%20desa.%20Apakah%20produknya%20masih%20tersedia%3F" class="btn bg-green btn-box btn-sm"  target="_blank" title="Hubungi"><i class="fa fa-whatsapp"></i> Hubungi</a> 
      <a href="<?= site_url("first/wisata_fasilitas/".$sub['id'])?>" target="_blank" class="btn bg-blue btn-box btn-sm"  target="_blank" title="Lihat Wisata"><i class="fa fa-whatsapp"></i> Lihat Wisata</a>
    </div>
  </div>
</div>
<div class="col-sm-9">
  <div class="box box-warning">
    <div class="box-body">
      <div id="map_penduduk"></div>
    </div>
  </div>
</div>
