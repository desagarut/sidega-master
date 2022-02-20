<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tab-pane" id="dok">
  <div class="box-header with-border">
    <h4 class="box-title">Dokumen</h4>
    <div class="box-tools">
      <button type="button" title="Tambah Dokumen" data-remote="false" data-toggle="modal" data-target="#modal" data-title="Tambah Dokumen" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" id="tambah_dokumen"><i class='fa fa-plus'></i>Tambah</button>
      <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#dokumen"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
        <thead>
          <tr>
            <th width="2" class="text-center">No</th>
            <th width="220">Judul Dokumen</th>
            <th width="200">Tanggal Upload</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($list_dokumen as $data){?>
          <tr>
            <td align="center" width="2"><?= $data['no']?></td>
            <td><a href="<?= site_url('mandiri_web/unduh_berkas/'.$data['id'].'/'.$data['id_pend'])?>">
              <?= $data['nama']?>
              </a></td>
            <td><?= tgl_indo2($data['tgl_upload'])?></td>
            <td></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
