<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>

<script>

var LokasiKantorKabupaten
var PetaKabupaten
var PetaKecamatan

function initMap() {
    <?php if (!empty($kabupaten['lat']) && !empty($kabupaten['lng'])): ?>
        var center = {
            lat: <?=$kabupaten['lat']?>,
            lng: <?=$kabupaten['lng']?>
        }
    <?php else: ?>
        var center = {
            lat: -7.229426071233562,
            lng: 107.88959092620838
        }
    <?php endif; ?>
        
    var zoom = 14
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    PetaKabupaten = new google.maps.Map(document.getElementById("peta_wilayah_kabupaten"), { 
		center, 
		zoom, 
		mapTypeId:google.maps.MapTypeId.HYBRID,
		title: 'Wilayah Kabupaten <?php echo ucwords($this->setting->sebutan_kabupaten)." "?><?php echo ucwords($kabupaten['nama_kabupaten'])?>',
	 });

    LokasiKantorKabupaten = new google.maps.Marker({
        position: center,
        map: PetaKabupaten,
        title: 'Lokasi Kantor <?php echo ucwords($this->setting->sebutan_kabupaten)." "?><?php echo ucwords($kabupaten['nama_kabupaten'])?>',
		animation: google.maps.Animation.BOUNCE,
    });
	

    <?php if (!empty($kabupaten['path'])): ?>
	let polygon_kabupaten = <?= $kabupaten['path']; ?>;
	
	polygon_kabupaten[0].map((arr, i) => {
		polygon_kabupaten[i] = { lat: arr[0], lng: arr[1] }
	})
	
	//Style polygon batas wilayah Kabupaten
	var batasWilayah = new google.maps.Polygon({
		paths: polygon_kabupaten,
		strokeColor: '#c31b68',
		strokeOpacity: 0.5,
		strokeWeight: 3,
		fillColor: '#fd7e14',
		fillOpacity: 0.35,
		title: 'Wilayah Kabupaten <?php echo ucwords($this->setting->sebutan_kabupaten); ?><?php echo ucwords($kabupaten['nama_kabupaten'])?>',
	});

	batasWilayah.setMap(PetaKabupaten)
    <?php endif; ?>
	
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    PetaKecamatan = new google.maps.Map(document.getElementById("peta_wilayah_kabupaten"), { 
		center, 
		zoom, 
		mapTypeId:google.maps.MapTypeId.HYBRID,
		title: 'Wilayah Kecamatan <?php echo ucwords($this->setting->sebutan_kabupaten)." "?><?php echo ucwords($kabupaten['nama_kecamatan'])?>',
	 });

    LokasiKantorKecamatan = new google.maps.Marker({
        position: center,
        map: PetaKecamatan,
        title: 'Lokasi Kantor <?php echo ucwords($this->setting->sebutan_kecamatan)." "?><?php echo ucwords($kabupaten['nama_kecamatan'])?>',
		animation: google.maps.Animation.BOUNCE,
    });
	

    <?php if (!empty($kecamatan['path'])): ?>
	let polygon_kecamatan = <?= $kecamatan['path']; ?>;
	
	polygon_kabupaten[0].map((arr, i) => {
		polygon_kabupaten[i] = { lat: arr[0], lng: arr[1] }
	})
	
	//Style polygon batas wilayah Kabupaten
	var batasWilayah = new google.maps.Polygon({
		paths: polygon_kecamatan,
		strokeColor: '#c31b68',
		strokeOpacity: 0.5,
		strokeWeight: 3,
		fillColor: '#fd7e14',
		fillOpacity: 0.35,
		title: 'Wilayah Kecamatan <?php echo ucwords($this->setting->sebutan_kecamatan); ?><?php echo ucwords($kabupaten['nama_kecamatan'])?>',
	});

	batasWilayah.setMap(PetaKecamatan)
    <?php endif; ?>
	
	
}
</script>

<!-- widget Peta Wilayah Kelurahan -->

<div class="map-section">
    <div class="col-sm-12">
      <div id="peta_wilayah_kabupaten" style="height: 500px"></div>
    </div>
</div>
