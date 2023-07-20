  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Progres Kependudukan</h3>
      <div class="box-tools pull-right">
        <a href="#"><span class="label label-danger"> New</span></a>
        <?php if ($this->CI->cek_hak_akses('h')) : ?>
          <a href="<?= site_url('penduduk') ?>"><span class="label label-info"> Detail</span></a>
        <?php endif; ?>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>

    <?php
    if (isset($data_ktp)) {
      $d = $data_ktp->row();
    ?>

      <div class="box-body">
        <!-- /.progress-group -->
        <div class="progress-group">
          <span class="progress-text">KTP Elektronik </span>
          <span class="progress-number">
            <?= $d->ktp_el_ya ?>/<?= $d->penduduk_total ?> <b>(<?= $d->persentase_ktp_el ?>%)</b> </span>

          <div class="progress sm">
            <div class="progress-bar progress-bar-red" style="width: <?= $d->persentase_ktp_el ?>%"></div>
          </div>
        </div>

        <div class="progress-group">
          <span class="progress-text">Foto Penduduk</span>
          <span class="progress-number"><?= $d->foto_y ?>/<?= $d->penduduk_total ?> <b>(<?= $d->persentase_foto ?>%)</b></span>
          <div class="progress sm">
            <div class="progress-bar progress-bar-aqua" style="width: <?= $d->persentase_foto ?>%"></div>
          </div>
        </div>
        <!-- /.progress-group -->
        <!--<div class="progress-group">
          <span class="progress-text">Arsip Dokumen </span>
          <span class="progress-number"><b><?= $d->ktp_el_ya ?></b>/<?= $d->penduduk_total ?> <b>(<?= $d->persentase_ktp_el ?>%)</b></span>

          <div class="progress sm">
            <div class="progress-bar progress-bar-green" style="width: 80%"></div>
          </div>
        </div>-->
        <!-- /.progress-group -->
        <div class="progress-group">
          <span class="progress-text">Foto Rumah </span>
          <span class="progress-number"><?= $d->rumah_y ?>/<?= $d->penduduk_total ?> <b>(<?= $d->persentase_rumah ?>%)</b></span>

          <div class="progress sm">
            <div class="progress-bar progress-bar-green" style="width: <?= $d->persentase_rumah ?>%"></div>
          </div>
        </div>
        <!-- /.progress-group -->
        <!-- /.progress-group -->
        <div class="progress-group">
          <span class="progress-text">Peta Lokasi Rumah </span>
          <span class="progress-number"><?= $d->lokasi_y ?>/<?= $d->penduduk_total ?> <b>(<?= $d->persentase_lokasi ?>%)</b></span>

          <div class="progress sm">
            <div class="progress-bar progress-bar-yellow" style="width: <?= $d->persentase_lokasi ?>%"></div>
          </div>
        </div>
        <!-- /.progress-group -->

      </div>
    <?php
    }
    ?>
  </div>
