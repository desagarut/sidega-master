    <!-- ======= Clients Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">
        <div class="row">

			<?php foreach($sinergi_program as $key => $program) : ?>
				<?php $baris[$program['baris']][$program['kolom']] = $program; ?>
			<?php endforeach; ?>

        <div class="owl-carousel testimonials-carousel" data-aos="fade-up" data-aos-delay="200">
			<?php foreach($baris as $baris_program) : ?>
            <div align="center">
                <div align="center" style="width:50%">
                    <?php $width = 100/count($baris_program)-count($baris_program)?>
                    <?php foreach($baris_program as $key => $program) : ?>
                        <span>
                            <a href="<?= $program['tautan'] ?>" target="_blank"><img src="<?= base_url().LOKASI_GAMBAR_WIDGET.$program['gambar'] ?>"  alt="<?= $program['judul'] ?>" /></a>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
			<?php endforeach; ?>
        </div>

      </div>
    </section><!-- End Clients Section -->

