<?php if ($this->CI->cek_hak_akses('u')) : ?>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Menu</h3>
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li class="<?php compared_return($selected_nav, "umkm_ststistik", "active"); ?>"><a href="<?= site_url('umkm') ?>">Statistik</a></li>
        <li class="<?php compared_return($selected_nav, "toko_warga", "active"); ?>"><a href="<?= site_url('toko_warga') ?>">Toko Warga</a></li>
        <li class="<?php compared_return($selected_nav, "pertukangan", "active"); ?>"><a href="<?= site_url('tukang') ?>">Pertukangan</a></li>
        <li class="<?php compared_return($selected_nav, 'transportasi', 'active'); ?>"><a href="<?= site_url('tawa') ?>">Transportasi</a></li>
        <li class="<?php compared_return($selected_nav, 'wisata', 'active'); ?>"><a href="<?= site_url('wisata') ?>">Wisata</a></li>
      </ul>
    </div>
  </div>

<?php endif; ?>