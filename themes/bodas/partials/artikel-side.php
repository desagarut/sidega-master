<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row shadow" style="padding: 10px 10px 10px 10px">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="tab">
            <button class="nav-link active" id="pills-terkini-tab" data-bs-toggle="pill" data-bs-target="#terkini" type="button" role="tab" aria-controls="pills-terkini" aria-selected="true">Terbaru</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-populer-tab" data-bs-toggle="pill" data-bs-target="#populer" type="button" role="presentation" aria-controls="pills-populer" aria-selected="true">Populer</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-acak-tab" data-bs-toggle="pill" data-bs-target="#acak" type="button" role="presentation" aria-controls="pills-populer" aria-selected="true">Acak</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <?php foreach (array('terkini' => 'arsip_terkini', 'populer' => 'arsip_populer', 'acak' => 'arsip_acak') as $jenis => $jenis_arsip) : ?>
            <div id="<?= $jenis ?>" class="tab-pane fade show <?php ($jenis == 'terkini') and print('active') ?>" role="tabpanel">
                <table id="ul-menu">
                    <?php foreach ($$jenis_arsip as $arsip) : ?>
                        <tr>
                            <td colspan="2" style="font-size: 11px;">
                                <span class="meta_date"><i class="fa fa-clock"></i> <?= tgl_indo($arsip['tgl_upload']); ?> | <i class="fa fa-eye"></i> <?= hit($arsip['hit']); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align="justify">
                                <a href="<?= site_url('artikel/' . buat_slug($arsip)) ?>">
                                    <?php if (is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $arsip[gambar])) : ?>
                                        <img width="25%" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail" src="<?= base_url(LOKASI_FOTO_ARTIKEL . 'sedang_' . $arsip[gambar]) ?>" />
                                    <?php else : ?>
                                        <img width="25%" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" />
                                    <?php endif; ?>
                                    <small>
                                        <font color="green"><?= $arsip['judul'] ?></font>
                                    </small>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div class="row shadow" style="padding: 10px 10px 10px 10px">
    <?php $nama = potong_teks($data['isi'], 10); ?>
    <div class="text-end py-3 mt-2">
        <a class="btn btn-info py-3 px-5 mt-2" style="border-radius: 30px 0 0 30px;" href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>">Youtube</a>
    </div>
    <?php foreach ($gallery_youtube as $data) : ?>
        <?php if ($data['link']) : ?>

            <div class="row">
                <div class="product-img col-sm-6">
                    <iframe height="100px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" style="font-size:11px">
                        <?= $data['nama'] ?>
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
</div>