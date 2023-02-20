
<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">S D M</h6>
            <h1 class="mb-5">Pemerintah Desa</h1>
        </div>
        <div class="row g-4 owl-carousel testimonial-carousel position-relative">
        <?php foreach($aparatur_desa['daftar_perangkat'] as $data) : ?>
            <div class="col-md-10 wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s">
                <div class="team-item bg-light">
                    <div class="overflow-hidden">
                        <img class="img-fluid" style="" src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                        <div class="bg-light d-flex justify-content-center pt-2 px-1">
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0"><?= $data['nama'] ?></h5>
                        <small><?= strtoupper($data['jabatan']) ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
    </div>
</div>

<!-- Team End -->


