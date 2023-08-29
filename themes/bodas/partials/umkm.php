<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Potensi</h6>
            <h1 class="mb-5">UMKM</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden text-center">
                        <div class="container-fluid p-1 mb-1">
                            <div class="owl-carousel header-carousel position-relative">
                                <?php if ($towa) : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <a href="<?= site_url('first/toko_show') ?>">
                                            <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/toko.png") ?>" alt="Toko Warga" style="width:100%; height:200px; fit:content">
                                        </a>
                                    </div>
                                    <?php foreach ($towa as $data) : ?>
                                        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
                                            <?php $link = site_url('first/produk_show/' . $data['id']) ?>
                                            <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                                <a href="<?= site_url('first/produk_show/' . $data['id']) ?>">
                                                    <img src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height:200px; fit:content">
                                                </a>
                                                <div class="text-center p-1 pb-1">
                                                    <h5 class="mb-1"><a href="<?= site_url('first/toko_show') ?>"><?= $data['nama'] ?></a></h5>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/toko.png") ?>" alt="Toko Warga" style="width:100%; height:200px; fit:content">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>*</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>144 SKS</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>*</small>
                </div>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden text-center">
                        <div class="container-fluid p-1 mb-1">
                            <div class="owl-carousel header-carousel position-relative">
                                <?php if ($tawa) : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <a href="<?= site_url('first/tawa') ?>">
                                            <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/transport.png") ?>" alt="Transportasi" style="width:100%; height:200px; fit:content">
                                        </a>
                                    </div>
                                    <?php foreach ($tawa as $data) : ?>
                                        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
                                            <?php $link = site_url('first/tawa_layanan/' . $data['id']) ?>
                                            <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                                <a href="<?= site_url('first/tawa_layanan/' . $data['id']) ?>">
                                                    <img src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height: 200px; fit:content">
                                                </a>
                                            </div>
                                            <div class="text-center p-1 pb-1">
                                                <h5 class="mb-1"><a href="<?= site_url('first/tawa') ?>"><?= $data['nama'] ?></a></h5>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/transport.png") ?>" alt="Transportasi" style="width:100%; height:200px; fit:content">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>654 Unit Usaha</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>144 SKS</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1.000+ Layanan</small>
                    </div>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden text-center">
                        <div class="container-fluid p-1 mb-1">
                            <div class="owl-carousel header-carousel position-relative">
                                <?php if ($tukang) : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <a href="<?= site_url('first/tukang') ?>">
                                            <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/tukang.png") ?>" alt="Transportasi" style="width:100%; height:200px; fit:content">
                                        </a>
                                    </div>
                                    <?php foreach ($tukang as $data) : ?>
                                        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
                                            <?php $link = site_url('first/tukang_layanan/' . $data['id']) ?>
                                            <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                                <a href="<?= site_url('first/tukang_layanan/' . $data['id']) ?>">
                                                    <img src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height: 200px; fit:content">
                                                </a>
                                                <div class="text-center p-1 pb-1">
                                                    <h5 class="mb-1"><a href="<?= site_url('first/tukang') ?>"><?= $data['nama'] ?></a></h5>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/tukang.png") ?>" alt="Transportasi" style="width:100%; height:200px; fit:content">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>654 Unit Usaha</small>
                       <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>144 SKS</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1.000+ Layanan</small>
                    </div>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden text-center">
                        <div class="container-fluid p-1 mb-1">
                            <div class="owl-carousel header-carousel position-relative">
                                <?php if ($wisata) : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <a href="<?= site_url('first/wisata_fasilitas') ?>">
                                            <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/wisata.png") ?>" alt="Transportasi" style="width:100%; height:200px; fit:content">
                                        </a>
                                    </div>
                                    <?php foreach ($wisata as $data) : ?>
                                        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
                                            <?php $link = site_url('first/wisata_fasilitas/' . $data['id']) ?>
                                            <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                                <a href="<?= site_url('first/wisata_fasilitas/' . $data['id']) ?>">
                                                    <img src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height: 200px; fit:content">
                                                </a>
                                                <div class="text-center p-1 pb-1">
                                                    <h5 class="mb-1"><a href="<?= site_url('first/wisata') ?>">Wisata</a></h5>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="portfolio-description" style="padding:10px 10px 10px 10px">
                                        <img class="img-fluid text-center" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/wisata.png") ?>" alt="Transportasi" style="width:100%; height:200px; fit:content">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!--<div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>654 Unit Usaha</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>144 SKS</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>1.000+ Layanan</small>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Courses End -->