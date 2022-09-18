<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>
<script>
  <?php if (!empty($lokasi['lat'] && !empty($lokasi['lng']))) : ?>
    var center = {
      lat: <?= $lokasi['lat'] . ", lng: " . $lokasi['lng']; ?>
    };
  <?php else : ?>
    var center = {
      lat: <?= $wil_atas['lat'] . ", lng: " . $wil_atas['lng'] ?>
    };
  <?php endif; ?>

  function initMap() {
    var myLatlng = new google.maps.LatLng(center.lat, center.lng);
    var mapOptions = {
      zoom: 14,
      center,
      mapTypeId: google.maps.MapTypeId.HYBRID
    }
    var map = new google.maps.Map(document.getElementById("map_lokasi"), mapOptions);

    // Place a draggable marker on the map
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      draggable: true,
      title: 'Lokasi Kantor <?php echo ucwords($list_lokasi_program['nama_program_kegiatan']) ?>',
      animation: google.maps.Animation.BOUNCE,
    });

    marker.addListener('dragend', (e) => {
      document.getElementById('lat').value = e.latLng.lat();
      document.getElementById('lng').value = e.latLng.lng();
    })
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
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0">Lokasi Usulan Masyarakat</h4>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
            <?php foreach ($breadcrumb as $tautan) : ?>
            <li><a href="<?= $tautan['link'] ?>">
              <?= $tautan['judul'] ?>
              </a></li>
            <?php endforeach; ?>
            <li class="active">Lokasi Usulan Masyarakat</li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  <!-- /.content-header --> 
  <!-- /.content-header -->
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('perencanaan_desa/menu'); ?>
      </div>
      <div class="col-md-9">
        <div class="box">
          <form action="<?= $form_action ?>" method="post" id="validasi" enctype="multipart/form-data">
            <div class='box-header'>
              <div class="row">
                <div class="col-sm-12">
                  <div id="map_lokasi"></div>
                  <input type="hidden" name="id" id="id" value="<?= $wil_ini['id'] ?>" />
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class='col-sm-12'>
                <div class="row col-sm-7">
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label class="col-sm-4 control-label " for="lat">Lat: </label>
                      <input type="text" class="col-md-6" name="lat" id="lat" value="<?= $lokasi['lat'] ?>" />
                      <br />
                      <label class="col-sm-4 control-label " for="lng"> Lng: </label>
                      <input type="text" class="col-md-6" name="lng" id="lng" value="<?= $lokasi['lng'] ?>" />
                    </div>
                    <div class="col-sm-6">
                      <label class="col-sm-4" for="zoom"> Zoom: </label>
                      <input type="text" class="col-md-6" width="5px" name="zoom" id="zoom" value="<?= $wil_ini['zoom'] ?>" />
                      <br />
                      <label class="col-sm-4" for="map_tipe"> Map Tipe: </label>
                      <select class="input-sm pull-left" name="map_tipe" id="map_tipe">
                        <option value="ROADMAP" <?php selected($map_tipe, 'ROADMAP'); ?>>ROADMAP</option>
                        <option value="SATELLITE" <?php selected($map_tipe, 'SATELLITE'); ?>>SATELLITE</option>
                        <option value="HYBRID" <?php selected($map_tipe, 'HYBRID'); ?>>HYBRID</option>
                      </select>
                      <!-- <input type="text" class="col-md-6" width="5px" name="map_tipe" id="map_tipe" value="<?= $wil_ini['map_tipe'] ?>" />--> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer float-right">
              <div class="col-sm-12"> <a href="<?= site_url('perencanaan_desa') ?>" class="btn btn-box bg-purple btn-sm" title="Kembali"> Kembali</a>
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
