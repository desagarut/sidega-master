<!-- ======= Gallery Youtube ======= -->
<div class="col-md-3">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Gallery Video Youtube</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <?php foreach ($gallery_youtube as $data) : ?>
        <?php if ($data['link']) : ?>
          <ul class="products-list product-list-in-box">
            <li class="item">
              <div class="product-img">
                <img src="<?= base_url("assets/files/logo/youtube.png") ?>" alt="Product Image">
              </div>
              <div class="product-info">
                <a href="<?= site_url("gallery_youtube/sub_gallery/{$data['id']}") ?>" class="product-title" alt="<?= $data['nama'] ?>"><?= $data[nama] ?>
                 <!-- <span class="label label-warning pull-right">$1800</span>-->
                </a>
                <span class="product-description">
                  <?= $data['tgl_upload'] ?>
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
      <a href="<?= site_url("gallery_youtube") ?>" class="uppercase">View All Video</a>
    </div>
    <!-- /.box-footer -->
  </div>
</div>