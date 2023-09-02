<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="col-md-12 text-start wow fadeInUp" data-wow-delay="0.1s">
        <h6 class="mb-3">CCTV Lainnya</h6>
    </div>
    <?php foreach ($cctv as $data) : ?>
        <?php if ($data['link']) : ?>
            <div class="row wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-img col-sm-6">
                    <iframe width="100%" height="50%" src="<?= $data["link"]; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-6 text-start">
                    <small>
                        <a href="<?= site_url("first/cctv_sub/{$data['id']}") ?>">
                            <?= strtoupper($data['nama']) ?>
                        </a><br />
                        <span class="product-description">
                            <small><?= $data['tgl_upload'] ?></small>
                        </span>
                    </small>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>