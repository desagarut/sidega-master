<!-- ======= Gallery Youtube ======= -->
<div class="col-md-3">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Artikel</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?php foreach ($artikel as $data) : ?>
        <?php if ($data['gambar']) : ?>
          <ul class="products-list product-list-in-box">
            <li class="item">
              <div class="product-img">
              <img width=50 height=80 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>
              <?php //if ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $data['gambar'])) : ?>
					<!--<img src="<?= AmbilFotoArtikel($data['gambar'], 'sedang') ?>" alt="<?= $data['judul'] ?>" id="current">-->
				<?php //endif ?>
              </div>
              <div class="product-info">
                <a href="#" class="product-title" alt="<?= $data['judul'] ?>"><?= $data['judul'] ?>
                 <!-- <span class="label label-warning pull-right">$1800</span>-->
                </a>
                <span class="product-description">
                  <?= $data['tgl_upload'] ?> | <?= $data['owner'] ?>
                </span>
              </div>
            </li>
            <!-- /.item -->
          </ul>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
      <a href="<?= site_url("web") ?>" class="uppercase">Semua Artikel</a>
    </div>
    <!-- /.box-footer -->
  </div>
</div>