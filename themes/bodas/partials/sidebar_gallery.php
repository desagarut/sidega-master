<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="col-md-12 text-start wow fadeInUp" data-wow-delay="0.1s">
    <h5 class="mb-3"><a href="<?= site_url("first/gallery/{$data['id']}") ?>">Gallery</a></h5>
    </div>
    <?php foreach ($w_gal as $data) : ?>
        <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>

            <div class="row py-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-img col-sm-4">
                    <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>">
                        <img src="<?= AmbilGaleri($data['gambar'], 'sedang') ?>" alt="<?= $article['judul'] ?>" style="object-fit: cover; width:100%; height:70px; ">
                    </a>
                </div>
                <div class="col-sm-8 text-end">
                    <small>
                        <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>">
                            <?= strtoupper($data['nama']) ?>
                        </a><br />
                        <span class="product-description">
                            <a><?= $data['isi'] ?></a>
                        </span>
                    </small>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>