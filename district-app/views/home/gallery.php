<!-- ======= Gallery Foto ======= -->

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gallery Foto</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <?php foreach ($gallery as $data) : ?>
      <?php if ($data['gambar']) : ?>
        <ul class="products-list product-list-in-box">
          <li class="item">
            <a href="<?= site_url("gallery/sub_gallery/{$data['id']}") ?>">
              <div class="product-img">
                <img width=50 height=80 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>
              </div>
              <div class="product-info">
                <?= $data['nama'] ?>
                <span class="product-description">
                  <?= $data['tgl_upload'] ?>
                </span>
              </div>
            </a>
          </li>
        </ul>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <div class="box-footer text-center">
    <a href="<?= site_url("gallery") ?>" class="uppercase">Semua Foto</a>
  </div>
</div>