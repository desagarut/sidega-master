<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="hero-area">
  <div class="container">
    <div class="row">
      <?php if($main) : ?>
      <div class="col-lg-8 col-12 custom-padding-right">
        <div class="slider-head"> 
          <!-- Start Hero Slider -->
          <div class="hero-slider">
            <?php foreach($main as $data) : ?>
            <?php if(is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
            <?php $link = site_url('first/produk_show/'.$data['id']) ?>
            <div class="single-slider"
                                style="background-image: url(<?= AmbilGaleri($data['gambar'],'sedang') ?>);">
              <div class="content">
                <h4 style="color:#FFF; text-shadow: 4px 4px 4px #081828; -webkit-text-stroke: 0.25px #081828;">
                  <?= $data['kategori_toko'] ?>
                </h4>
                <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828; -webkit-text-stroke: 0.25px #081828;">UMKM :
                  <?= $data['nama'] ?>
                </h2>
                <div class="row"> <a class="" href="<?= site_url('first/produk_show/'.$data['id']) ?>">
                  <button class="button btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> UMKM:
                  <?= $data['nama'] ?>
                  </button>
                  </a> <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="pesan">
                  <button class="button btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
                  </a> </div>
              </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>
          </div>
          <!-- End Hero Slider --> 
        </div>
      </div>
      <?php endif ?>
      <div class="col-lg-4 col-12">
        <div class="row">
          <div class="col-lg-12 col-md-6 col-12 md-custom-padding"> 
            <!-- Start Small Banner -->
            <div class="hero-small-banner"
                                style="background-image: url('<?php echo base_url('desa/logo/umkm_juara.jpg')?>');">
              <div class="content" style="padding-top:180px">
                <h2 style="color:#FC0; text-shadow: 4px 4px 4px #081828; -webkit-text-stroke: 0.25px #081828;"> "Tinggal di desa, Rezeki kota, Bisnis mendunia" </h2>
                <h3 style="text-shadow: 4px 4px 4px #FFF;">~ Ridwan Kamil ~</h3>
              </div>
            </div>
            <!-- End Small Banner --> 
          </div>
          <div class="col-lg-12 col-md-6 col-12"> 
            <!-- Start Small Banner -->
            <div class="hero-small-banner style2">
              <div class="content">
                <h2>Belanja mingguan?</h2>
                <p>Dapatkan diskon hingga 50% di toko kesayangan anda!.</p>
                <div class="button"> <a class="btn" href="<?= site_url('first/toko_show/') ?>">Belanja Sekarang</a> </div>
              </div>
            </div>
            <!-- Start Small Banner --> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Start Hero Area --> 
<!--    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider --> 
<!--                        <div class="hero-slider">
							<?php $active = true; ?>
                            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
                            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
                            <?php if(is_file($file_gambar)) : ?>
                            <!-- Start Single Slider --> 
<!--                            <div class="single-slider"
                                style="background-image: url(<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>);">
                                <div class="content">
                                    <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828;
    -webkit-text-stroke: 0.25px #081828;"><span></span>
                                        <?= $gambar['judul'] ?>
                                    </h2>
                                    <p></p>
                                    <h3><span>Now Only</span> $320.99</h3>
                                    <div class="button">
                                        <a href="<?='artikel/'.buat_slug($gambar); ?>" class="btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
<?php $active = false; ?>
<?php endif; ?>
<?php endforeach; ?>
<!--                        </div>
                        <!-- End Hero Slider --> 
<!--                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                            <!-- Start Small Banner --> 
<!--                            <div class="hero-small-banner"
                                style="background-image: url('<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>');">
                                <div class="content">
                                    <h2>
                                        <span>New line required</span>
                                        iPhone 12 Pro Max
                                    </h2>
                                    <h3>$259.99</h3>
                                </div>
                            </div>
                            <!-- End Small Banner --> 
<!--                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner --> 
<!--                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>Weekly Sale!</h2>
                                    <p>Saving up to 50% off all online store items this week.</p>
                                    <div class="button">
                                        <a class="btn" href="<?= site_url('first/toko_show/') ?>">Belanja Sekarang</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner --> 
<!--                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area --> 

<!--    
    <?php if($main) : ?>
      <div class="col-md-8">
        <div class="portfolio-details-container" data-aos="fade-right" data-aos-delay="300">
          <div class="owl-carousel portfolio-details-carousel">
            <?php foreach($main as $data) : ?>
            <?php if(is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
            <?php $link = site_url('first/produk_show/'.$data['id']) ?>
            <div class="portfolio-description"> <a class="archive__link" href="<?= site_url('first/produk_show/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'sedang') ?>" class="img-fluid" alt="<?= $data['nama'] ?>"> </a>
              <div class="portfolio-info">
                <h3> <a class="" href="<?= site_url('first/produk_show/'.$data['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> UMKM:
                  <?= $data['nama'] ?>
                  </button>
                  <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="pesan">
                  <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
                  </a> </h3>
              </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <?php //$this->load->view($folder_themes .'/partials/toko_warga/qr-code.php') ?>
      </div>
      <?php endif ?>
-->