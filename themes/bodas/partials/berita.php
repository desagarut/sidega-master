<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $abstract = potong_teks($headline['isi'], 250); ?>
<?php $url = site_url('artikel/' . buat_slug($headline)); ?>
<?php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $headline['gambar'])) ?
    AmbilFotoArtikel($headline['gambar'], 'sedang') :
    base_url($this->theme_folder . '/' . $this->theme . '/assets/images/placeholder.png') ?>

<!-- Berita Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Berita</h6>
            <h1 class="mb-5">Terkini</h1>
        </div>

        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp shadow" data-wow-delay="0.1s" style="height: 300px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="<?= $image ?>" alt="<?= $headline['judul'] ?>" style="object-fit: content;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">Sorotan</h6>
                <h1 class="mb-4"><?= $headline['judul'] ?></h1>
                <p class="mb-4"><?= $abstract ?></p>
                <!--<div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skilled Instructors</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Online Classes</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>International Certificate</p>
                    </div>
                </div>-->
                <?= tgl_indo($article['tgl_upload']) ?> - <?= $article['owner'] ?><br />
                <a class="btn btn-warning py-3 px-5 mt-2" style="border-radius: 30px 0 0 30px;" href="<?= $url ?>">Baca</a>
                <a class="btn btn-primary py-3 px-5 mt-2" style="border-radius: 0 30px 30px 0;" href="<?= site_url('arsip') ?>">Semua Berita</a>

            </div>
        </div>
        <div class="row py-2">
            <?php $this->load->view($folder_themes . '/partials/artikel_single') ?>
        </div>
    </div>
</div>
<!-- Berita End -->