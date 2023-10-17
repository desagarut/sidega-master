<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tab-pane" id="keluarga">
  <div class="box-header with-border">
    <h5><b>Rincian Keluarga</b></h5>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover tabel-rincian">
        <tbody>
          <tr>
            <td width="20%">Nomor Kartu Keluarga (KK)</td>
            <td width="1%">:</td>
            <td><?= $kepala_kk['no_kk']?></td>
          </tr>
          <tr>
            <td>Kepala Keluarga</td>
            <td>:</td>
            <td><?= $kepala_kk['nama']?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $kepala_kk['alamat_wilayah']?></td>
          </tr>
          <tr>
            <td><?= ($program['programkerja']) ? anchor("program_bantuan/peserta/2/$kepala_kk[no_kk]", 'Program Bantuan', 'target="_blank"') : 'Program Bantuan'; ?></td>
            <td>:</td>
            <td><?php if($program['programkerja']): ?>
              <?php foreach ($program['programkerja'] as $item): ?>
              <?= anchor("program_bantuan/data_peserta/$item[peserta_id]", '<span class="label label-success">' . $item['nama'] . '</span>&nbsp;', 'target="_blank"'); ?>
              <?php endforeach; ?>
              <?php else: ?>
              -
              <?php endif; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="box-body">
    <h5><b>Daftar Anggota Keluarga</b></h5>
    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
      <form id="mainform" name="mainform" action="" method="post">
        <div class="table-responsive">
          <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
            <thead class="bg-gray disabled color-palette">
              <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Hubungan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($main as $key => $data): ?>
              <tr>
                <td class="padat"><?= ($key + 1); ?></td>
                <td><?= $data['nik']?></td>
                <td nowrap width="45%"><?= strtoupper($data['nama'])?></td>
                <td nowrap><?= tgl_indo($data['tanggallahir'])?></td>
                <td><?= $data['sex']?></td>
                <td nowrap><?= $data['hubungan']?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
  <div class='modal fade' id='confirm-status' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
          <h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
        </div>
        <div class='modal-body btn-info'> </div>
        <div class='modal-footer'>
          <button type="button" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
          <a class='btn-ok'>
          <button type="button" class="btn btn-social btn-box btn-info btn-sm" id="ok-delete"><i class='fa fa-check'></i> Simpan</button>
          </a> </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
          <h4 class='modal-title' id='myModalLabel'></h4>
        </div>
        <div class="fetched-data"></div>
      </div>
    </div>
  </div>
</div>
