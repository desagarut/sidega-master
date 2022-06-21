<!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-in">
        <div class="clients-slider swiper-container">
		<?php foreach($sinergi_program as $key => $program) : ?>
        <?php $baris[$program['baris']][$program['kolom']] = $program; ?>
		<?php endforeach; ?>
          <div class="swiper-wrapper align-items-center">
			<?php foreach($baris as $baris_program) : ?> 
            <div class="swiper-slide" align="center">
            <?php $width = 100/count($baris_program)-count($baris_program)?>
			<?php foreach($baris_program as $key => $program) : ?>
            <a href="<?= $program['tautan'] ?>" target="_blank"><img src="<?= base_url().LOKASI_GAMBAR_WIDGET.$program['gambar'] ?>" class="img-fluid" alt="<?= $program['judul'] ?>"></a>
			<?php endforeach; ?>
            </div>
			<?php endforeach; ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Clients Section -->