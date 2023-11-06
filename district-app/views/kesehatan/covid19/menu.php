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
        <li class="<?php compared_return($selected_nav, "data", "active"); ?>"><a href="<?= site_url('covid19') ?>">Pendataan Suspek Covid</a></li>
      </ul>
      <ul class="nav nav-pills nav-stacked">
        <li class="<?php compared_return($selected_nav, "pantau", "active"); ?>"><a href="<?= site_url('covid19/pantau') ?>">Pemantauan Suspek Covid</a></li>
      </ul>
      <ul class="nav nav-pills nav-stacked">
        <li class="<?php compared_return($selected_nav, "vaksin", "active"); ?>"><a href="<?= site_url('covid19_vaksin') ?>">Pendataan Vaksin Covid</a></li>
      </ul>
    </div>
  </div>

<?php endif; ?>