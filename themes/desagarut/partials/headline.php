<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $abstract = potong_teks($headline['isi'], 180); ?>
<?php $url = site_url('artikel/'.buat_slug($headline)); ?>
<?php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$headline['gambar'])) ? 
	AmbilFotoArtikel($headline['gambar'],'kecil') :
	base_url($this->theme_folder.'/'.$this->theme .'/assets/images/placeholder.png') ?>

      <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">	
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
			<script async src="https://cse.google.com/cse.js?cx=3af5e9768545cb414"></script>
            <div class="gcse-search"></div>
          <h2 data-aos="fade-up"><a href="<?= $url ?>"><?= $headline['judul'] ?></a></h2>
          <h2 data-aos="fade-up" data-aos-delay="100"><p><?= $abstract ?>...</p></h2>
          <div data-aos="fade-up" data-aos-delay="200">
            <a href="<?= $url ?>" class="btn-get-started scrollto">Lanjut baca</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="150">
          <img src="<?= $image ?>" class="img-fluid" alt="<?= $headline['judul'] ?>">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->
