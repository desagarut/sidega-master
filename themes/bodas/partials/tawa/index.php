<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Layanan</h6>
            <h1 class="mb-5">Transportasi Warga</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <?php if ($main) : ?>

                <?php foreach ($main as $data) : ?>
                    <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
                        <?php $link = site_url('first/tawa_layanan/' . $data['id']) ?>

                        <div class="col-lg-3 col-md-3 col-sm-2 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="course-item bg-light">
                                <div class="position-relative overflow-hidden">
                                <a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>"><img class="img-fluid" style="width:100%" src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" alt="<?= $data['nama'] ?>"></a>
                                    <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                        <a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3 border-end" style="border-radius: 30px 0 0 30px;">Lihat</a>
                                        <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20layanan%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/tawa_layanan/'.$data['id']) ?>" target="_blank" title="Hubungi via whatsapp" class="flex-shrink-0 btn btn-sm btn-success px-3" style="border-radius: 0 30px 30px 0;">
                                        Hubungi <i class="fa fa-comments"></i></a>
                                    </div>
                                </div>
                                <div class="text-center p-4 pb-0">
                                    <h5 class="mb-0"><a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>"><?= $data['nama'] ?></a></h5>
                                    <h6 class="mb-4"><i class="fa fa-map-marker-alt text-danger"></i> <?= $data['lokasi'] ?></h6>
                                    <div class="text-start">
                                    <small>Area Layanan : <?= $data['area'] ?></small> <br/>
                                    <small>Tujuan : <?= $data['trayek'] ?></small><br/>
                                    <small>Jenis : <?= $data['jenis_usaha'] ?></small><br/>
                                    <small>Kelompok : <?= $data['kelompok_usaha'] ?></small>
                                    </div>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i><?= $data['nama_pengelola'] ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>

        </div>
    </div>
</div>
<!-- Courses End -->

<?php $this->load->view($folder_themes . '/partials/service_umkm.php') ?>