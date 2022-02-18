<!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-left">
          <h2>Gallery Kegiatan</h2>
        </div>


        <div class="row portfolio-container" data-aos="fade-up">
		<?php foreach ($w_gal As $data): ?>
		<?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])): ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="<?= AmbilGaleri($data['gambar'],'kecil')?>" class="img-fluid" alt="" width="350">
            <div class="portfolio-info">
              <h4><?= "Album : $data[nama]" ?></h4>
              <a href="<?= AmbilGaleri($data['gambar'],'kecil')?>" data-gall="portfolioGallery" class="venobox preview-link" title="<?= "Album : $data[nama]" ?>"><i class="bx bx-plus"></i></a>
              <a href="<?= site_url('first/gallery');?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
		<?php endif; ?>
        <?php endforeach; ?>

        </div>

      </div>
    </section><!-- End Portfolio Section -->