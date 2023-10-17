<div class='col-md-3'>
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">CCTV</h3>
      <div class="box-tools pull-right">
        <span class="label label-danger"> New</span>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> </button>
      </div>
    </div>
    <div class="box-body text-center">
      <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php foreach ($gallery_cctv as $data) : ?>
              <?php //if ($data['link']) : 
              ?>
              <div class="item active">
                <iframe width="100%" height="130" src="<?= $data["link"]; ?>" frameborder="0" allowfullscreen></iframe>
                <div class="carousel-caption">
                  <h6 class="mb-0"><?= strtoupper($data['nama']) ?></h6>
                </div>
              </div>
              <?php //endif; 
              ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer text-center scroller">
      <a href="<?= site_url('gallery_cctv'); ?>"> Semua CCTV</a>
    </div>
  </div>
</div>