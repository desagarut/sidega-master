<!-- ======= Artikel ======= -->
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
                <?php if ($data['gambar']) : ?>
                  <img style="width:100%;height:50px" src="<?= AmbilFotoArtikel($data['gambar'], 'sedang') ?>" alt="<?= $data['nama'] ?>">
                <?php else : ?>
                  <img style="width:100%;height:50px" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="<?= $data['nama'] ?>" style="width:40px">
                <?php endif; ?>
                <!--<img width=50 height=80 src=<?= AmbilFotoArtikel(urldecode($data['gambar']), 'kecil') ?>>-->
              </div>
              <div class="product-info">
                <?php if ($this->CI->cek_hak_akses('u')) : ?>
                  <a href="<?= site_url("web/form/$data[id]") ?>" class="product-title" alt="<?= $data['judul'] ?>"><?= $data['judul'] ?>
                  </a>
                <?php else : ?>
                  <?= $data['judul'] ?>
                <?php endif; ?>
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