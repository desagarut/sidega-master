<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxsKE9ArOZcaNtsfXIMFqr4N-UCsmp-Ng&callback=initMap"
    defer
></script>
<script>

var LokasiKantorDesa
var PetaDesa
var PetaDusun

function initMap() {
    <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
        var center = {
            lat: <?=$desa['lat']?>,
            lng: <?=$desa['lng']?>
        }
    <?php else: ?>
        var center = {
            lat: -7.229426071233562,
            lng: 107.88959092620838
        }
    <?php endif; ?>
        
    var zoom = 13
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    PetaDesa = new google.maps.Map(document.getElementById("peta_wilayah_desa"), { 
		center, 
		zoom, 
		mapTypeId:google.maps.MapTypeId.HYBRID,
		title: 'Wilayah Desa <?php echo ucwords($this->setting->sebutan_desa)." "?><?php echo ucwords($desa['nama_desa'])?>',
	 });

    LokasiKantorDesa = new google.maps.Marker({
        position: center,
        map: PetaDesa,
        title: 'Lokasi Kantor <?php echo ucwords($this->setting->sebutan_desa)." "?><?php echo ucwords($desa['nama_desa'])?>',
		animation: google.maps.Animation.BOUNCE,
    });
	

    <?php if (!empty($desa['path'])): ?>
	let polygon_desa = <?= $desa['path']; ?>;
	
	polygon_desa[0].map((arr, i) => {
		polygon_desa[i] = { lat: arr[0], lng: arr[1] }
	})
	
	//Style polygon batas wilayah desa
	var batasWilayah = new google.maps.Polygon({
		paths: polygon_desa,
		strokeColor: '#c31b68',
		strokeOpacity: 0.5,
		strokeWeight: 3,
		fillColor: '#fd7e14',
		fillOpacity: 0.35,
		title: 'Wilayah Desa <?php echo ucwords($this->setting->sebutan_desa); ?><?php echo ucwords($desa['nama_desa'])?>',
	});

	batasWilayah.setMap(PetaDesa)
    <?php endif; ?>
	
}
</script>

<!-- widget Peta Wilayah Kelurahan -->

<div class="map-section" style="padding-top:70px">
    <div class="col-sm-12">
      <div id="peta_wilayah_desa" style="height: 250px"></div>
    </div>
</div>
<!-- ======= Our Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><i class="ri-store-2-fill" style="color:#e80368;"></i> TOKO <strong>WARGA</strong></h2>
          <p><strong>Toko Warga </strong>adalah informasi tentang seluruh pedagang yang ada di wilayah <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>, pedagang yang terdaftar dalam Toko Warga terdiri atas seluruh penduduk yang memiliki aktivitas perdagangan di wilayah <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>. Baik penduduk tetap, sementara, maupun penduduk luar desa.<br/>
          Layanan <strong>Toko Warga</strong> memudahkan semua dalam berniaga, pemerintah desa hanya menyediakan fasilitas saja, tidak terlibat dalam transaksi jual beli didalamnya. Pembeli dapat menghubungi penjual secara langsung melalui whatsapp / telepon.<br/>
          Guna memudahkan dalam penggunaan layanan, sebaiknya baca <a href="#">Syarat & Ketentuan Layanan</a> terlebih dahulu.</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 align-items-stretch">
            <div class="member" data-aos="fade-up">
              <div class="member-img">
						<?php foreach ($toko_warga_produk as $key => $value): ?>
                        <a href="#" data-toggle="modal" data-target="#<?= $value->id ?>"><img src="<?= base_url() . LOKASI_GALERI . $value->gambar ?>" width="280px"  height="180px"></a>
                        <?php endforeach;?>
									    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/elektronik.jpg" ) ?>" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4><?= $toko_warga->nama_usaha ?> / Soni Jaya</h4>
                <span>Toko Elektronik Tercanggih</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
               <!-- <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/kedai.jpg" ) ?>" class="img-fluid" alt="">-->
                <img src="<?= base_url(LOKASI_GALERI) ?>${data.foto}" class="img-circle" alt="Gambar Toko">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Aa Odo</h4>
                <span>Warung Kopi Panas Wae</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/masakan.jpg" ) ?>" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Dapur Teh Lia</h4>
                <span>Aneka Masakan Siap Saji</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/bonsai.jpg" ) ?>" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Mayo Plant</h4>
                <span>Aneka Bibit Tanaman </span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Our Team Section -->
