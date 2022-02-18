		<!-- OpenStreetMap Css -->
		<link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet-geoman.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/L.Control.Locate.min.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/MarkerCluster.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/MarkerCluster.Default.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet-measure-path.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/mapbox-gl.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/L.Control.Shapefile.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet.groupedlayercontrol.min.css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/peta.css">
        
		<!-- OpenStreetMap Js-->
		<script src="<?= base_url()?>assets/js/leaflet.js"></script>
		<script src="<?= base_url()?>assets/js/turf.min.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet-geoman.min.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.filelayer.js"></script>
		<script src="<?= base_url()?>assets/js/togeojson.js"></script>
		<script src="<?= base_url()?>assets/js/togpx.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet-providers.js"></script>
		<script src="<?= base_url()?>assets/js/L.Control.Locate.min.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.markercluster.js"></script>
		<!--<script src="<?= base_url()?>assets/js/peta.js"></script>-->
		<script src="<?= base_url()?>assets/js/leaflet-measure-path.js"></script>
		<script src="<?= base_url()?>assets/js/apbdes_manual.js"></script>
		<script src="<?= base_url()?>assets/js/mapbox-gl.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet-mapbox-gl.js"></script>
		<script src="<?= base_url()?>assets/js/shp.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.shpfile.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.groupedlayercontrol.min.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.browser.print.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.browser.print.utils.js"></script>
		<script src="<?= base_url()?>assets/js/leaflet.browser.print.sizes.js"></script>
		<script src="<?= base_url()?>assets/js/dom-to-image.min.js"></script>
        
        

<!-- widget Peta Wilayah Kelurahan -->
            <div>
				<div>
                    <div>
                        <!--<h5>Peta Wilayah Kelurahan</h5>-->
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
				 	<div>
                        <div id="map_wilayah" style="height:250px; width:400px;"></div>
                    </div>
                </div>
            </div>

<script>
  //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
  <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
    var posisi = [<?=$desa['lat'].",".$desa['lng']?>];
    var zoom = <?=$desa['zoom'] ?: 10?>;
  <?php else: ?>
    var posisi = [-7.229426071233562,107.88959092620838];
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
    var kantor_deskel = L.polygon(polygon_desa, style_polygon).bindTooltip("Wilayah Desa").addTo(wilayah_desa);
    wilayah_desa.fitBounds(kantor_deskel.getBounds());
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