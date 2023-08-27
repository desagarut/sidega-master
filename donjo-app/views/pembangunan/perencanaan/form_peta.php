<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOKTzsvtw8j-TJI8dmJ228bXASq4C-S7U&callback=initMap&v=weekly" defer></script>

<script>
  <?php if (!empty($lokasi_pembangunan->lat && !empty($lokasi_pembangunan->lng))) : ?>
    var center = {
      lat: <?= $lokasi_pembangunan->lat . ", lng: " . $lokasi_pembangunan->lng; ?>
    };
  <?php else : ?>
    var center = {
      lat: <?= $wil_atas['lat'] . ", lng: " . $wil_atas['lng'] ?>
    };
  <?php endif; ?>

  function initMap() {
    var myLatlng = new google.maps.LatLng(center.lat, center.lng);
    var mapOptions = {
      zoom: 20,
      center,
      mapTypeId: google.maps.MapTypeId.HYBRID
    }
    var map = new google.maps.Map(document.getElementById("map_lokasi"), mapOptions);

    // Place a draggable marker on the map
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      draggable: true,
      title: 'Lokasi Pembangunan <?php echo ucwords($lokasi_pembangunan->nama_program_kegiatan) ?>',
      animation: google.maps.Animation,
    });

    marker.addListener('dragend', (e) => {
      document.getElementById('lat').value = e.latLng.lat();
      document.getElementById('lng').value = e.latLng.lng();
    });

    var infowindow = new google.maps.InfoWindow({
      content: "<div class='media text-center'><img src='<?= base_url() . LOKASI_GALERI . $lokasi_pembangunan->foto ?>' width='150px' height='100px'><br/> <p>Lokasi Usulan Kegiatan</p></div>",
    });

    infowindow.open(map, marker);

  }
</script>
<style>
  #map_lokasi {
    z-index: 1;
    width: 100%;
    height: 400px;
    border: 1px solid #000;
    margin-top: auto;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Peta Lokasi Usulan Kegiatan</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?= site_url('hom_sid') ?>">Usulan Masyarakat</a></li>
      <li class="active">Lokasi Usulan Kegiatan</li>
    </ol>
  </section>

  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-9">
        <div class="box box-info">
          <form action="<?= $form_action ?>" method="post" id="validasi" enctype="multipart/form-data">
            <div class="box-header">
              <h4>Lokasi Usulan Kegiatan : <?= $lokasi_pembangunan->nama_program_kegiatan ?></h4>
            </div>
            <div class="box-body">
              <div class="row" style="padding-bottom: 10px">
                <div class="col-sm-12">
                  <div id="map_lokasi"></div>
                  <input type="hidden" name="id" id="id" value="<?= $wil_ini['id'] ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-3 control-label " for="lat">Lat: </label>
                    <input type="text" class="col-md-6" name="lat" id="lat" value="<?= $lokasi_pembangunan->lat ?>" /><br />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-3 control-label " for="lng"> Lng: </label>
                    <input type="text" class="col-md-6" name="lng" id="lng" value="<?= $lokasi_pembangunan->lng ?>" />
                  </div>
                </div>
              </div>
              <div class="box-footer text-right">
                <div class="col-sm-12"> <a href="<?= site_url('pembangunan') ?>" class="btn btn-box bg-purple btn-sm" title="Kembali"> Kembali</a>
                  <?php if ($this->CI->cek_hak_akses('h')) : ?>
                    <a href="#" class="btn btn-box btn-success btn-sm" download="SIDeGa_Lokasi_Wilayah_<?php echo ucwords($desa['nama_desa']) ?>.gpx" id="exportGPX"><i class='fa fa-download'></i> Export ke GPX</a>
                    <button type="reset" class="btn btn-box btn-danger btn-sm"><i class='fa fa-sign-out'></i> Tutup</button>
                    <button type="submit" class="btn btn-box btn-info btn-sm"><i class='fa fa-check'></i> Simpan</button>
                  <?php endif; ?>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>