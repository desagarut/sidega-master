<!-- ======= Portfolio Section ======= -->
<!--
  <section id="portfolio" class="portfolio">
    <div class="container">
      <div class="section-title" data-aos="fade-left">
        <h2>Gallery Kegiatan
          <?= ucfirst($this->setting->sebutan_desa)?>
        </h2>
      </div>
      <div class="row portfolio-container" data-aos="fade-up">
        <?php foreach ($w_gal As $data): ?>
        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])): ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-app"> 
            	<a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>"><img src="<?= AmbilGaleri($data['gambar'],'kecil')?>" class="img-fluid" alt="" width="350"></a>
              <div class="portfolio-info">
                <h4>
                  <?= "Album : $data[nama]" ?>
                </h4>
                <a href="<?= AmbilGaleri($data['gambar'],'kecil')?>" data-gall="portfolioGallery" class="venobox preview-link" title="<?= "Album : $data[nama]" ?>"><i class="bx bx-plus"></i></a> <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a> </div>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <!-- End Portfolio Section --> 


<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Gallery Kegiatan
            <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </h2>
        </div>
      </div>
    </div>
    <div class="row">
		<?php foreach ($w_gal As $data): ?>
        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])): ?>
      <div class="col-lg-3 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> 
          	<img src="<?= AmbilGaleri($data['gambar'],'kecil')?>" alt="<?= $article['judul'] ?>"> 
            <div class="button">
                <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" class="btn"><i class="lni lni-eye"></i> Lihat</a>
            </div>
          </div>
          <div class="product-info">
            <h4 class="title"> <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" alt="<?= $article['judul'] ?>">
              <?= "Album : $data[nama]" ?>
              </a> </h4>
            </div>
        </div>
        <!-- End Single Product --> 
      </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
  </div>
</section>
