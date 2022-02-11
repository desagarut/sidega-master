  <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>Team <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
            </div>
            <div class="row">
                <div class="col-lg-6 hero-img d-flex flex-column" data-aos="fade-right">
                    <?php $this->load->view($folder_themes .'/widgets/map_google_kantor') ?>
                </div>
                <div class="owl-carousel testimonials-carousel col-lg-6 pt-5 pt-lg-0 order-2 order-lg-2 hero-img d-flex flex-column" data-aos="fade-left">
                    <?php foreach($aparatur_desa['daftar_perangkat'] as $data) : ?>
                        <div class="member" data-aos="fade-up" data-aos-delay="100">
                            <img class="img-fluid" alt="<?= $data['nama'] ?>" src="<?= $data['foto'] ?>" >
                            <div class="social" align="center">
                              <a href=""><i class="icofont-twitter"></i></a>
                              <a href=""><i class="icofont-facebook"></i></a>
                              <a href=""><i class="icofont-instagram"></i></a>
                              <a href=""><i class="icofont-linkedin"></i></a>
                            </div>
                            <div class="member-info" align="center">
                            <h4><?= $data['nama'] ?></h4>
                            <span><?= $data['jabatan'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->

