<!-- widget Peta Wilayah Desa -->
<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">
        <i class="fa fa-map-marker"></i>
        <?="Wilayah ".ucwords($this->setting->sebutan_desa)?></h3>
    </div>
    <div class="box-body">
        <div id="map_wilayah" style="height:200px;"></div>
        <a href="<?=site_url()?>gis">Buka peta</a>
    </div>
</div>

<script>
  //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
  <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
    var posisi = [<?=$desa['lat'].",".$desa['lng']?>];
    var zoom = <?=$desa['zoom'] ?: 10?>;
  <?php else: ?>
    var posisi = [-1.0546279422758742,116.71875000000001];
    var zoom = 10;
  <?php endif; ?>
  //Style polygon
  var style_polygon = {
    stroke: true,
    color: '#FF0000',
    opacity: 1,
    weight: 2,
    fillColor: '#8888dd',
    fillOpacity: 0.5
  };
  var wilayah_desa = L.map('map_wilayah').setView(posisi, zoom);

  //Menampilkan BaseLayers Peta
  var defaultLayer = L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(wilayah_desa);

  var baseLayers = {
    'OpenStreetMap': defaultLayer,
    'Mapbox Streets Satellite' : L.tileLayer('https://api.mapbox.com/v4/mapbox.streets-satellite/{z}/{x}/{y}@2x.png?access_token=<?=$this->setting->google_key?>', {attribution: '<a href="https://www.mapbox.com/about/maps">© Mapbox</a> <a href="https://openstreetmap.org/copyright">© OpenStreetMap</a>'}),
  };

  L.control.layers(baseLayers, null, {position: 'topright', collapsed: true}).addTo(wilayah_desa);

  <?php if (!empty($desa['path'])): ?>
    var polygon_desa = <?= $desa['path']; ?>;
    var kantor_desa = L.polygon(polygon_desa, style_polygon).bindTooltip("Wilayah Desa").addTo(wilayah_desa);
    wilayah_desa.fitBounds(kantor_desa.getBounds());
  <?php endif; ?>
</script>


<style type="text/css">
	button.btn {
		margin-left: 0px;
	}

	#collapse2 {
		margin-top: 5px;
	}

	button[aria-expanded=true] .fa-chevron-down {
		display: none;
	}

	button[aria-expanded=false] .fa-chevron-up {
		display: none;
	}

	.tabel-info {
		width: 100%;
	}

	.tabel-info, tr {
		border-bottom: 1px;
		border: 0px solid;
	}

	.tabel-info, td {
		border: 0px solid;
		height: 30px;
		padding: 5px;
	}

</style>

<!-- widget Peta Lokasi Kantor Desa -->
<div class="box box-primary box-solid">
	<div class="box-header">
		<h3 class="box-title">
			<i class="fa fa-map-marker"></i><?="Lokasi Kantor ".ucwords($this->setting->sebutan_desa)?>
		</h3>
	</div>
	<div class="box-body">
		<div id="map_lokasi" style="height:200px;"></div>
		<button class="btn btn-success btn-block"><a href="<?=site_url()?>gis" style="color:#fff;" target="_blank">Buka Peta</a></button>
		<button class="btn btn-success btn-block" data-toggle="collapse" data-target="#collapse2" aria-expanded="false">
			Detail
			<i class="fa fa-chevron-up pull-right"></i>
			<i class="fa fa-chevron-down pull-right"></i>
		</button>
		<div id="collapse2" class="panel-collapse collapse">
			<br>
			<?php if (is_file(FCPATH . LOKASI_LOGO_DESA . $desa['kantor_desa'])): ?>
				<img class="img-responsive" src="<?=gambar_desa($desa['kantor_desa'], TRUE)?>" alt="Kantor Desa">
				<hr>
			<?php endif; ?>
			<div class="info-desa">
				<table class="table-info">
					<tr>
						<td width="25%">Alamat</td>
						<td>:</td>
						<td width="70%"><?=$desa['alamat_kantor']?></td>
					</tr>
					<tr>
						<td width="25%"><?=ucwords($this->setting->sebutan_desa)." "?></td>
						<td>:</td>
						<td width="70%"><?=$desa['nama_desa']?></td>
					</tr>
					<tr>
						<td width="25%"><?=ucwords($this->setting->sebutan_kecamatan)?></td>
						<td>:</td>
						<td width="70%"><?=$desa['nama_kecamatan']?></td>
					</tr>
					<tr>
						<td width="25%"><?=ucwords($this->setting->sebutan_kabupaten)?></td>
						<td>:</td>
						<td width="70%"><?=$desa['nama_kabupaten']?></td>
					</tr>
					<tr>
						<td width="25%">Kodepos</td>
						<td>:</td>
						<td width="70%"><?=$desa['kode_pos']?></td>
					</tr>
					<tr>
						<td width="25%">Telepon</td>
						<td>:</td>
						<td width="70%"><?=$desa['telepon']?></td>
					</tr>
					<tr>
						<td width="25%">Email</td>
						<td>:</td>
						<td width="70%"><?=$desa['email_desa']?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsKE9ArOZcaNtsfXIMFqr4N-UCsmp-Ng&callback=initMap">
</script>


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
    height: 500px;
    border: 1px solid #000;
	margin-top:auto;
  }
</style>
