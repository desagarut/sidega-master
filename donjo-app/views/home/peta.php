<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>

<script>
var map
var kantorDesa

function initMap() {
    <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
        var center = {
            lat: <?=$desa['lat']?>,
            lng: <?=$desa['lng']?>
        }
    <?php else: ?>
        var center = {
            lat: -7.34298008144879,
            lng: 107.217667252986,
        }
    <?php endif; ?>
        
    var zoom = 13
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    map = new google.maps.Map(document.getElementById("map-wilayah-desa"), { center, zoom:<?=$desa['zoom']?>, mapTypeId:google.maps.MapTypeId.<?=$desa['map_tipe']?>});

    kantorDesa = new google.maps.Marker({
        position: center,
        map: map,
        title: 'Kantor <?php echo ucwords($this->setting->sebutan_desa)." "?><?php echo ucwords($desa['nama_desa'])?>',
        animation: google.maps.Animation.BOUNCE
    });

    <?php if (!empty($desa['path'])): ?>
        let polygon_desa = <?= $desa['path']; ?>;
        
        polygon_desa[0].map((arr, i) => {
            polygon_desa[i] = { lat: arr[0], lng: arr[1] }
        })
        
        //Style polygon
        var batasWilayah = new google.maps.Polygon({
            paths: polygon_desa,
			strokeColor: '#c31b68',
			strokeOpacity: 0.9,
			strokeWeight: 3,
			fillColor: '#fd7e14',
			fillOpacity: 0.25
        });

        batasWilayah.setMap(map)
    <?php endif; ?>
}
</script>

<!-- widget Peta Wilayah Desa -->

<div class='col-md-8'>
  <div class="box box-primary box-solid no-padding">
    <div class="box-header">
      <h3 class="box-title">Peta Desa</h3>
      <div class="box-tools pull-right"> <a href="<?=site_url()?>gis/clear"><span class="label label-warning">Buka peta</span></a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class='row'>
        <div class="pad">
          <div id="map-wilayah-desa" style="height: 280px"></div>
        </div>
      </div>
      &nbsp;
      <div class="row">
        <?php $this->load->view('home/kependudukan.php');?>
      </div>
    </div>
  </div>
</div>
