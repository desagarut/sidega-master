<div class='col-md-3'>
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">Video Profil Desa</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> </button>
      </div>
    </div>
    <div class="box-body text-center">
          <iframe height="160px" width="250px" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $setting_desa["video"]; ?>" title="Profil Desa" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="box-footer text-center scroller">
      <a href="<?= site_url('identitas_desa/form'); ?>" class="btn btn-box btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Ubah Data"><i class="fa fa-edit"></i> Ubah Video</a>
    </div>
  </div>
</div>