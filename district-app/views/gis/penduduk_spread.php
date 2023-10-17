<!--<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/ionicons.min.css">-->
<link rel="stylesheet" href="<?= base_url() ?>assets/css/leaflet.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/fonts.googleapis.com.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/ace.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-skins.min.css" />

<!--<script src="<?= base_url() ?>assets/bootstrap/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>-->
<script src="<?= base_url() ?>assets/js/leaflet.js"></script>
<script src="<?= base_url() ?>assets/js/ace-elements.min.js"></script>
<script src="<?= base_url() ?>assets/js/ace.min.js"></script>

		<div class="page-content">

			<div class="col-sm-6">
				<div class="panel panel-success">
					<div class="panel-heading">Lokasi Pembangunan</div>
					<div class="panel-body">
						<div id="map" style="height: 340px;"></div>
					</div>
				</div>
			</div>

		</div>



<script>
	var map = L.map('map').setView([<?= $penduduk['lat'] ?>, <?= $penduduk['lng'] ?>], 18);
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	var logo = L.icon({
		iconUrl: '<?= favico_desa() ?>',
		iconSize: [32, 32], // size of the icon
		//iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
		popupAnchor: [-1, 1] // point from which the popup should open relative to the iconAnchor
	});

	var info_tempat = "<div class='media text-center'>";
	info_tempat += "<div class='media-center'>";
	info_tempat += "<img class='media-object' src='<?= AmbilFoto($penduduk->foto, 'kecil') ?>' width='200px' height='100px'>";
	info_tempat += "</div>";
	info_tempat += "<div class='media-body '>";
	info_tempat += "<p><b><?= $penduduk['nama'] ?></b></p>";
	info_tempat += "</div>";
	info_tempat += "</div>";

	L.marker([<?= $penduduk['lat'] ?>, <?= $penduduk['lng'] ?>], {
			icon: logo
		}).addTo(map)
		.bindPopup(info_tempat).openPopup();
</script>