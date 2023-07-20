<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Pegawai Login</h3>
    <div class="box-tools pull-right">
      <?php if ($this->CI->cek_hak_akses('h')) : ?>
        <a href="<?= site_url('man_user') ?>"><span class="label label-default"> Detail</span></a>
      <?php endif; ?>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>

  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Waktu</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($last_login_operator as $key => $data) { ?>
            <tr>
              <td><?= $data['nama'] ?></td>
              <td><?= $data['grup'] ?></td>
              <td>
                <div class="sparkbar" data-color="#00a65a" data-height="20"><?= tgl_indo2($data['last_login']) ?></div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
