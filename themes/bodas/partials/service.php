<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <?php foreach ($sinergi_program as $key => $program) : ?>
            <?php $baris[$program['baris']][$program['kolom']] = $program; ?>
        <?php endforeach; ?>

        <div class="row g-4 owl-carousel testimonial-carousel position-relative">
            <?php foreach ($baris as $baris_program) : ?>
                <?php $width = 100 / count($baris_program) - count($baris_program) ?>
                <?php foreach ($baris_program as $key => $program) : ?>
                    <div class="testimonial-item text-center shadow">
                        <a href="<?= $program['tautan'] ?>" target="_blank">
                            <div class="service-item text-center pt-2">
                                <div class="p-2">
                                    <img src="<?= base_url() . LOKASI_GAMBAR_WIDGET . $program['gambar'] ?>" class="p-0 mx-auto mb-0" style="width: 150px; height: 100px;"><br>
                                    <h5 class="mb-1"><?= $program['judul'] ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>
            <?php endforeach; ?>
            <!--
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.3s">
                <a href="https://sisalsa-garutkab.smartvillage.info/index.php/auth/login">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="https://garutkab.smartvillage.info/assets/img/sisalsa.svg" class="p-0 mx-auto mb-0" style="width: 150px; height: 100px;"><br>
                            <h5 class="mb-1"> Sis Info Salur Dana Desa</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.5s">
                <a href="https://sitanti-garutkab.smartvillage.info/">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="https://garutkab.smartvillage.info/assets/img/sitanti.png" class="p-0 mx-auto mb-0" style="width: 150px; height: 100px;"><br>
                            <h5 class="mb-1"> Sis Info Transaksi Non Tunai</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="https://djponline.pajak.go.id/account/login">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="https://garutkab.smartvillage.info/assets/img/djp.svg" class="p-0 mx-auto mb-0" style="width: 150px; height: 100px;"><br>
                            <h5 class="mb-1"> Direktorat Jenderal Pajak Online</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="https://djponline.pajak.go.id/account/login">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="https://garutkab.smartvillage.info/assets/img/eis.svg" class="p-0 mx-auto mb-0" style="width: 150px; height: 100px;"><br>
                            <h5 class="mb-1"> Excecutive Information System</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="https://djponline.pajak.go.id/account/login">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="https://garutkab.smartvillage.info/assets/img/ibc.svg" class="p-0 mx-auto mb-0" style="width: 150px; height: 100px;"><br>
                            <h5 class="mb-1"> Internet Bank Corporate</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="<?= site_url('first/tawa') ?>">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/transport.png") ?>" class="p-0 mx-auto mb-0" style="width: 100px; height: 100px;"><br>
                            <h5 class="mb-1"> Transportasi Warga</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="<?= site_url('first/tukang') ?>">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/tukang.png") ?>" class="p-0 mx-auto mb-0" style="width: 100px; height: 100px;"><br>
                            <h5 class="mb-1"> Pertukangan</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="<?= site_url('first/wisata') ?>">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/wisata.png") ?>" class="p-0 mx-auto mb-0" style="width: 100px; height: 100px;"><br>
                            <h5 class="mb-1"> Wisata Desa</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="wow fadeInUp testimonial-item text-center shadow" data-wow-delay="0.7s">
                <a href="<?= site_url('first/toko_show') ?>">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                        <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/icon/toko.png") ?>" class="p-0 mx-auto mb-0" style="width: 100px; height: 100px;"><br>
                            <h5 class="mb-1"> Toko Warga</h5>
                        </div>
                    </div>
                </a>
            </div>
            -->
        </div>
    </div>
</div>
<!-- Service End -->