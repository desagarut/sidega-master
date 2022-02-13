<!-- widget Peta Wilayah Desa -->

<div class='col-md-8'>
  <div class='box box-success box-solid'>
    <div class="box-header with-border">
      <h3 class="box-title">Peta Desa</h3>
      <div class="box-tools pull-right"> <a href="<?=site_url()?>gis/clear"><span class="label label-warning">Buka peta</span></a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class='box-body'>
    <div class="pad">
      <div id="map_wilayah" style="height:200px;"></div>
      </div>
      <div class="row">
		<?php $this->load->view('home/kependudukan.php');?>
      </div>
    </div>
  </div>
</div>
<script>
  //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
  <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
    var posisi = [<?=$desa['lat'].",".$desa['lng']?>];
    var zoom = <?=$desa['zoom'] ?: 10?>;
  <?php else: ?>
    var posisi = [-7.34298008144879,107.217667252986];
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
    var kantor_desa = L.polygon(polygon_desa, style_polygon).bindTooltip("Wilayah <?=ucwords($this->setting->sebutan_desa).' '.$desa['nama_desa']?>").addTo(wilayah_desa);
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
