<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tab-pane" id="dok">
  <div class="box-header with-border">
    <h4 class="box-title">Dokumen</h4>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
        <thead>
          <tr>
            <th width="2" class="text-center">No</th>
            <th width="20%">Aksi</th>
            <th width="30%">Nama Dokumen</th>
            <th width="30%">Jenis Dokumen</th>
            <th width="30%">Tanggal Upload</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list_dokumen as $data) { ?>
            <tr>
              <td align="center" width="2"><?= $data['no'] ?></td>
              <td><label data-rel="popover" data-content="<img width=550 height=400 src=<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($data['satuan']) ?>>">
                  <button class="btn btn-sm btn-success">
                    Lihat
                  </button></label>&nbsp;
                <a href="<?= site_url('mandiri_web/unduh_berkas/' . $data['id'] . '/' . $data['id_pend']) ?>" class="btn btn-sm bg-navy">
                  Unduh
                </a>
              </td>
              <td>
                <label data-rel="popover" data-content="<img width=550 height=400 src=<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($data['satuan']) ?>>">
                  <strong><?= strtoupper($data['nama']); ?></strong>
                </label>
              </td>
              <td></td>
              <td><?= tgl_indo2($data['tgl_upload']) ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php foreach ($data as $key => $data) : ?>
  <div class="modal fade" id="#sampul<?= $data->id ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Foto <?= strtoupper($data['nama']); ?></h4>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img src="<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($data['satuan']) ?>" width="800px" height="500px">
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<div class="modal fade" id="sampul<?= $data->id ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Gambar</h4>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img src="<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($data['satuan']) ?>" width="800px" height="500px">
        </div>
      </div>
    </div>
  </div>
</div>