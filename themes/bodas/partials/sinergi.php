<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">Program</h6>
            <h1 class="mb-5">Mitra Sinergi </h1>
        </div>
        <?php foreach ($sinergi_program as $key => $program) : ?>
            <?php $baris[$program['baris']][$program['kolom']] = $program; ?>
        <?php endforeach; ?>

        <div class="owl-carousel testimonial-carousel position-relative">
            <?php foreach ($baris as $baris_program) : ?>
                <?php $width = 100 / count($baris_program) - count($baris_program) ?>
                <?php foreach ($baris_program as $key => $program) : ?>
                    <a href="<?= $program['tautan'] ?>" target="_blank">
                        <div class="testimonial-item text-center">
                            <img class="border rounded-circle p-2 mx-auto mb-3" src="<?= base_url() . LOKASI_GAMBAR_WIDGET . $program['gambar'] ?>" style="width: 80px; height: 80px;">
                            <h5 class="mb-0"><?= $program['judul'] ?></h5>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- Testimonial End -->