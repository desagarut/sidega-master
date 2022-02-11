<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsKE9ArOZcaNtsfXIMFqr4N-UCsmp-Ng&callback=initMap">
</script>


<script>
<?php if (!empty($toko['lat'] && !empty($toko['lng']))): ?>
	var center = { lat: <?= $toko['lat'].", lng: ".$toko['lng']; ?> };
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
			draggable: true,
			title: "Lokasi <?=$toko['nama']?>"
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

<div class="content-wrapper">
	<section class="content-header">
		<h1>Lokasi : <?=$toko['nama']?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('toko_warga') ?>"> Daftar Toko</a></li>
			<li class="active">Lokasi <?=$toko['nama']?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
                <form id="validasi1" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">	
                <div class='modal-body'>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="map_penduduk"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class='col-xs-12'>
                           <a href="<?= site_url("toko_warga")?>" class="pull-left"> <button type="#" class="btn btn-social btn-box btn-primary btn-sm"><i class='fa fa-arrow-left'></i> Kembali</button></a>
                            <input type="text" name="lat" id="lat" value="<?= $toko['lat']?>"/>
                            <input type="text" name="lng" id="lng" value="<?= $toko['lng']?>" />
                            <button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-refresh'></i> Reset</button>
                            <button type="submit" class="btn btn-social btn-box btn-success btn-sm"><i class='fa fa-check'></i> Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
				</div>
            </div>
        </div>
	</section>
</div>