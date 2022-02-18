<style type='text/css'>
body img {
	-webkit-transition: -webkit-transform 1.1s ease-in-out;
	transition: transform 1.1s ease-in-out;
}
body img:hover {
	-webkit-transform: rotate(360deg);
	transform: rotate(360deg);
}
</style>

<!-- ======= Features Section ======= -->
<section id="features" class="features" >
  <div class="row" data-aos="fade-left" data-aos-delay="300">
  <div class="col-lg-12 col-md-4 mt-0">
    <h2><i class="ri-store-2-fill" style="color:#e80368;"></i> UMKM <strong style="color:#C00">TOKO WARGA</strong></h2>
    <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/toko.png" ) ?>" class="img-fluid" alt="<?= $album['nama'] ?>"> </div>
  <div class="col-lg-12 col-md-4 mt-1">
    <div class="icon-box">
      <marquee behavior="alternate" scrollamount="1">
      <a href="<?= site_url('first/toko_show') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/toko.png" ) ?>" width="70px" /> </a> <a href="<?= site_url('first/tukang') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/tukang.png" ) ?>" width="70px" /> </a> <a href="<?= site_url('first/tawa') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/transport.png" ) ?>" width="70px" /> </a> <a href="<?= site_url('first/wisata') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/wisata.png" ) ?>" width="70px" /> </a>
      </marquee>
    </div>
  </div>
</section>
<!-- End Features Section -->