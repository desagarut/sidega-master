<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="active tab-pane" id="resume"> 
  <!-- The Resume -->
  <ul>
    <!-- timeline time label -->
    <li>
      <div class="box box-warning">
        <div class="box-header">Lokasi Rumah</div>
        <div class="box-body">
          <?php $this->load->view('web/mandiri/penduduk_map.php');?>
        </div>
      </div>
    </li>
    <li>
      <div class="box box-warning">
        <div class="box-header">Foto Rumah</div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-hover detail">
            <tr>
              <th class="padat">No</th>
              <th width="20%">Nama </th>
              <th width="40%">Foto</th>
              <th width="15%">File</th>
              <th width="15%">Tanggal Upload</th>
            </tr>
            <?php foreach ($list_rumah as $key => $data): ?>
            <tr>
              <td class="text-center"><?= $key + 1; ?></td>
              <td><?= $data['nama']?></td>
              <td><img class="img-responsive img-circle" src="<?= base_url().LOKASI_RUMAH?><?= urlencode($data['satuan']); ?>" alt="Foto Rumah Penduduk"></td>
              <td><a href="<?= base_url().LOKASI_RUMAH?><?= urlencode($data['satuan']); ?>" >
                <?= $data['satuan']; ?>
                </a></td>
              <td><?= tgl_indo2($data['tgl_upload']); ?></td>
            </tr>
            <?php endforeach;?>
          </table>
        </div>
      </div>
    </li>
    <li>
      <div class="box box-warning">
        <div class="box-header">Program Bantuan</div>
<div class="box-body">
                    <?php if ($bantuan_penduduk) : ?>
                        <b>SASARAN PENDUDUK</b>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="1">No.</th>
                                        <th class="text-center" width="1">Aksi</th>
                                        <th>Masa Program</th>
                                        <th>Nama Program</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($bantuan_penduduk as $no => $bantuan) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no + 1; ?></td>
                                        <td nowrap>
                                            <?php if($bantuan['no_id_kartu']) : ?>
                                                <button type="button" target="data_peserta" title="Data Peserta" href="<?= site_url("mandiri_web/kartu_peserta/tampil/$bantuan[id]")?>" onclick="show_kartu_peserta($(this));" class="btn btn-success btn-box btn-sm" ><i class="fa fa-eye"></i></button>
                                                <a href="<?= site_url("mandiri_web/kartu_peserta/unduh/$bantuan[id]")?>" class="btn bg-black btn-box btn-sm" title="Kartu Peserta" <?php empty($bantuan['kartu_peserta']) and print('disabled')?>><i class="fa fa-download"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td nowrap><?= fTampilTgl($bantuan["sdate"], $bantuan["edate"]);?></td>
                                        <td><?= $bantuan['nama']?></td>
                                        <td width="60%"><?= $bantuan["ndesc"];?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <span>Maaf Anda saat ini tidak terdaftar dalam program bantuan apapun</span>
                    <?php endif; ?>
                </div>
                      </div>
    </li>
    <li> <small><a href="#"> Data Awal : <i class="fa fa-clock-o"></i>
      <?= tgl_indo2($penduduk['created_at']);?>
      -- <i class="fa fa-user"></i>Oleh:
      <?= $penduduk['nama_pendaftar']?>
      </a></small> </li>
  </ul>
</div>
