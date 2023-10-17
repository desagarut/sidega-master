<?php if ($this->CI->cek_hak_akses('u')) : ?>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Menu</h3>
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> </button>
      </div>
    </div>
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 1) and print('active') ?>"><a href="<?= site_url('gallery_cctv') ?>">CCTV <?= ucfirst($this->setting->sebutan_desa) ?></a></li>
      <li class="<?php ($this->tab_ini == 2) and print('active') ?>"><a href="#">CCTV Luar <?= ucfirst($this->setting->sebutan_desa) ?></a></li>
      </ul>
    </div>
  </div>

<?php endif; ?>