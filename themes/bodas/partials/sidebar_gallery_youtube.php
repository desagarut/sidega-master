<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $nama = potong_teks($data['isi'], 10); ?>
<div class="text-end py-3 mt-2">
    <a class="btn btn-info py-3 px-5 mt-2" style="border-radius: 30px 0 0 30px;" href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>">Playlist</a>
</div>
<?php foreach ($gallery_youtube as $data) : ?>
    <?php if ($data['link']) : ?>

        <div class="row shadow">
            <div class="product-img col-sm-6">
                <iframe height="100px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-sm-6 text-end">
                <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>">
                    <small><?= $data['nama'] ?></small>
                    <!-- <span class="label label-warning pull-right">$1800</span>-->
                </a><br />
                <span class="product-description">
                    <small><?= $data['tgl_upload'] ?></small>
                </span>
            </div>
        </div>
        &nbsp;
    <?php endif; ?>
<?php endforeach; ?>