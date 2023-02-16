<?php if ($this->CI->cek_hak_akses('u')) : ?>

  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Menu</h3>
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li class="<?php compared_return($selected_nav, "peraturan", "active"); ?>"><a href="<?= site_url('dokumen_sekretariat/clear/3') ?>">Buku Peraturan Desa</a></li>
        <li class="<?php compared_return($selected_nav, "keputusan", "active"); ?>"><a href="<?= site_url('dokumen_sekretariat/clear/2') ?>">Buku Keputusan Kepala Desa</a></li>
        <li class="<?php compared_return($selected_nav, "aparat", "active"); ?>"><a href="<?= site_url('pengurus') ?>">Buku Aparat Pemerintah Desa</a></li>
        <li class="<?php compared_return($selected_nav, 'inventaris', 'active'); ?>"><a href="<?= site_url('ba_inventaris_kekayaan') ?>">Buku Inventaris dan Kekayaan <?= ucwords($this->setting->sebutan_desa); ?></a></li>

        <li class="<?php compared_return($selected_nav, 'tanah_kas', 'active'); ?>"><a href="<?= site_url('ba_tanah_kas_desa/clear') ?>">Buku Tanah Kas <?= ucwords($this->setting->sebutan_desa); ?></a></li>
        <li class="<?php compared_return($selected_nav, 'tanah', 'active'); ?>"><a href="<?= site_url('ba_tanah_desa/clear') ?>">Buku Tanah di <?= ucwords($this->setting->sebutan_desa); ?></a></li>

        <li class="<?php compared_return($selected_nav, "agenda_masuk", "active"); ?>"><a href="<?= site_url('surat_masuk') ?>">Buku Agenda - Surat Masuk</a></li>
        <li class="<?php compared_return($selected_nav, "agenda_keluar", "active"); ?>"><a href="<?= site_url('surat_keluar') ?>">Buku Agenda - Surat Keluar</a></li>
        <li class="<?php compared_return($selected_nav, "ekspedisi", "active"); ?>"><a href="<?= site_url('ekspedisi/clear') ?>">Buku Ekspedisi</a></li>
        <li class="<?php compared_return($selected_nav, "lembaran", "active"); ?>"><a href="<?= site_url('buku_umum/lembaran_desa/clear') ?>">Buku Lembaran Desa dan Berita Desa</a></li>
        <li class="<?php compared_return($selected_nav, "dokumen_lainnya", "active"); ?>"><a href="<?= site_url('dokumen/dokumen_lainnya') ?>">Buku Peraturan Lainnya</a></li>
        <!--<li class="<?php compared_return($selected_nav, "agenda", "active"); ?>"><a href="<?= site_url('web/tab/1000') ?>">Agenda Desa</a></li>-->
      </ul>
    </div>
  </div>


<?php endif; ?>