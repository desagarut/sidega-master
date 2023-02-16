<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $nama = potong_teks($data['isi'], 10); ?>
<ul class="products-list product-list-in-box">
    <li class="text-end"><a href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>" class="btn btn-sm btn-dark btn-box"><i class="lni lni-list"> </i> Go to Playlist</a>
    </li>&nbsp;
    <?php foreach ($gallery_youtube as $data) : ?>
        <?php if ($data['link']) : ?>

            <li class="item">
                <div class="row">
                    <div class="product-img col-sm-6">
                        <iframe height="100px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>">
                            <small><?= $data['nama'] ?></small>
                            <!-- <span class="label label-warning pull-right">$1800</span>-->
                        </a>
                        <span class="product-description">
                            <small><?= $data['tgl_upload'] ?></small>
                        </span>
                    </div>
                </div>
            </li>&nbsp;
        <?php endif; ?>
    <?php endforeach; ?>
</ul>