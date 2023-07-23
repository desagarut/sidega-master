<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$penduduk = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1')->result_array()[0]['jumlah'];
$penduduk_laki = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 1')->result_array()[0]['jumlah'];
$penduduk_perempuan = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 2')->result_array()[0]['jumlah'];
$keluarga = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_keluarga')->result_array()[0]['jumlah'];
$keluarga_laki = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 1 and kk_level = 1')->result_array()[0]['jumlah'];
$keluarga_perempuan = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 2 and kk_level = 1')->result_array()[0]['jumlah'];
$rtm = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_rtm')->result_array()[0]['jumlah'];
$id = $this->db->query('SELECT COUNT(id) AS jumlah FROM log_surat')->result_array()[0]['jumlah'];
?>

<!-- Profil Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Profil</h6>
            <h1 class="mb-5"><?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?></h1>
        </div>
        <div class="row g-3 bg-light">
            <div class="col-lg-6 col-md-6">
                <div class="col-lg-12 col-md-12 wow zoomIn bg-light" data-wow-delay="0.5s">
                    <a class="position-relative d-block overflow-hidden" href="">
                        <img class="img-fluid" src="<?= gambar_desa($desa['kantor_desa']) ?>" style="height:350px; width:100%" alt="<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>">
                        <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                            <h5 class="m-0">Kantor</h5>
                            <small class="text-primary"><?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?></small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 wow zoomIn bg-light" data-wow-delay="0.7s">
                <?php $this->load->view($folder_themes . '/widgets/map_tentang') ?>
            </div>
            <div class="col-lg-12 col-md-12 wow zoomIn bg-light" data-wow-delay="0.3s" style="padding: 10px 10px 10px 10px;">
                <div class="info-body custom-responsive-margin">
                    <p>
                        <?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>
                        adalah salah satu
                        <?= ucfirst($this->setting->sebutan_desa); ?>
                        yang terletak di <?= ucwords($this->setting->sebutan_kecamatan . " " . $desa['nama_kecamatan']) ?>
                        <?= ucwords($this->setting->sebutan_kabupaten . " " . $desa['nama_kabupaten']) ?>
                        Provinsi
                        <?= ucwords($this->setting->sebutan_propinsi . " " . $desa['nama_propinsi']) ?>
                        , Dengan Batas Wilayah: <br>
                    <ul class="features">
                        <li>Di Utara berbatasan dengan
                            <?= ucwords($desa['batas_utara']) ?>
                        </li>
                        <li>Di Selatan berbatasan dengan
                            <?= ucwords($desa['batas_selatan']) ?>
                        </li>
                        <li>Di Timur berbatasan dengan
                            <?= ucwords($desa['batas_timur']) ?>
                        </li>
                        <li>Di Barat berbatasan dengan
                            <?= ucwords($desa['batas_barat']) ?>
                        </li>
                    </ul>
                    <br />
                    <?= ucwords($this->setting->profil_singkat . " " . $desa['profil_singkat']) ?>
                </div>
                <?php if ($setting_desa['video']) : ?>
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.7s" style="height: 350px; padding-top:20px">
                        <iframe style="width: 100%; height: 100%" src="https://www.youtube.com/embed/<?= $setting_desa["video"]; ?>" title="Profil Desa" frameborder="0" allow="clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php endif ?>

                <div class="container-xxl py-5">
                    <div class="row g-4">
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item text-center pt-3">
                                <div class="p-4">
                                    <i class="fa fa-3x fa-users text-primary mb-4"></i>
                                    <h5 class="mb-3"><?= number_format($penduduk, 0, '', '.') ?></h5>
                                    <p> Penduduk</br>
                                        L : <?= number_format($penduduk_laki, 0, '', '.') ?> ( <?= number_format($penduduk_laki / $penduduk * 100, 0, '', '.') ?>% )</br>
                                        P : <?= number_format($penduduk_perempuan, 0, '', '.') ?> ( <?= number_format($penduduk_perempuan / $penduduk * 100, 0, '', '.') ?>%)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="service-item text-center pt-3">
                                <div class="p-4">
                                    <i class="fa fa-3x fa-user-cog text-primary mb-4"></i>
                                    <h5 class="mb-3"><?= number_format($keluarga, 0, '', '.') ?></h5>
                                    <p>Kepala Keluarga</br>
                                        L : <?= number_format($keluarga_laki, 0, '', '.') ?> ( <?= number_format($keluarga_laki / $keluarga * 100, 0, '', '.') ?>% )</br>
                                        P : <?= number_format($keluarga_perempuan, 0, '', '.') ?> ( <?= number_format($keluarga_perempuan / $keluarga * 100, 0, '', '.') ?>%)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="service-item text-center pt-3">
                                <div class="p-4">
                                    <i class="fa fa-3x fa-home text-primary mb-4"></i>
                                    <h5 class="mb-3"><?= number_format($rtm, 0, '', '.') ?></h5>
                                    <p>Bangunan Rumah Tangga</br>
                                        Layak : <?= number_format($rtm, 0, '', '.') ?> ( <?= number_format($rtm / $rtm * 100, 0, '', '.') ?>% )</br>
                                        Tidak Layak : <?= number_format($rtm_no, 0, '', '.') ?> ( <?= number_format($rtm_no / $rtm * 100, 0, '', '.') ?>%)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="service-item text-center pt-3">
                                <div class="p-4">
                                    <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                                    <h5 class="mb-3"><?= number_format($id, 0, '', '.') ?></h5>
                                    <p>Pelayanan Surat Menyurat</br>
                                        Warga : <?= number_format($id, 0, '', '.') ?> ( <?= number_format($id / $id * 100, 0, '', '.') ?>% )</br>
                                        Non Warga : <?= number_format($id_no, 0, '', '.') ?> ( <?= number_format($id_no / $id * 100, 0, '', '.') ?>%)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profil Start -->