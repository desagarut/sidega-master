<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="mb-5"><a href="<?= site_url('first/pemerintahan_desa') ?>">Pemerintahan Desa </a></h2>
                </div>
                <div class="row g-3 owl-carousel header-carousel position-relative">
                    <?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
                        <div class="col-md-12 text-center wow fadeInUp header-item text-center" data-wow-delay="0.1s" style="width:100%%; padding:0px 40px 0px 40px">
                            <div class="team-item bg-light" style="padding:10px 15px 0px 15px">
                                <div class="overflow-hidden">
                                    <a href="<?= site_url('first/pemerintahan_desa') ?>">
                                        <?php if ($data['foto']): ?>
                                            <img class="img-fluid" style="object-fit: cover; height:350px" src="<?= $data['foto'] ?>" alt="foto <?= $data['nama'] ?>" />
                                        <?php else: ?>
                                            <img class="img-fluid" style="object-fit: cover; height:350px" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="<?= $data['nama'] ?>" />
                                        <?php endif ?>
                                    </a>
                                </div>
                                <div class="position-relative d-flex justify-content-center" style="margin-top: -30px;">
                                    <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="text-center p-4">
                                    <h6 class="mb-0"><?= strtoupper($data['nama']) ?></h6>
                                    <small><?= strtoupper($data['jabatan']) ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.5s bg-info">
                <div class="text-center wow fadeInUp" data-wow-delay="0.5s">
                    <h2 class="mb-5"><a href="<?= site_url('first/bpd') ?>">Badan Permusyawatan Desa </a></h2>
                </div>
                <div class="row g-3 owl-carousel header-carousel position-relative">
                    <?php foreach ($bpd as $data) : ?>
                        <div class="col-md-12 text-center wow fadeInUp header-item text-center" data-wow-delay="0.1s" style="width:100%%; padding:0px 40px 0px 40px">
                            <div class="team-item bg-light" style="padding:10px 15px 0px 15px">
                                <div class="overflow-hidden">
                                    <a href="<?= site_url('first/bpd') ?>">
                                        <?php if ($data['foto']): ?>
                                            <img class="img-fluid" style="object-fit: cover; height:350px" src="<?= AmbilFoto($data['foto']) ?>" alt="foto <?= $data['nama'] ?>" />
                                        <?php else: ?>
                                            <img class="img-fluid" style="object-fit: cover; height:350px" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="<?= $data['nama'] ?>" />
                                        <?php endif ?>
                                    </a>
                                </div>
                                <div class="position-relative d-flex justify-content-center" style="margin-top: -30px;">
                                    <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="text-center p-4">
                                    <h6 class="mb-0"><?= strtoupper($data['nama']) ?></h6>
                                    <small><?= strtoupper($data['jabatan']) ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Team End -->